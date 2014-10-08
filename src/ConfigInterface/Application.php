<?php

namespace ConfigInterface;

use Utilities;
use Symfony\Component\Yaml\Yaml;

class Application
{
    public function __construct()
    {
        \Mage::app();
    }

    /**
     * @return string
     */
    public function getConfigAsYaml()
    {
        $configCollectionAsArray = $this->getConfigAsArray();
        return Yaml::dump($configCollectionAsArray, 2);
    }

    /**
     * @return array
     */
    protected function getConfigAsArray()
    {
        $configCollection = \Mage::getModel('core/config_data')->getCollection();
        return Utilities::collectionToArray($configCollection);
    }

    /**
     * @param string $yaml
     * @return bool
     * @throws \Exception
     */
    public function importConfigFromYaml($yaml)
    {
        $configAsArray = Yaml::parse($yaml);

        foreach ($configAsArray as $configItem) {
            if (!array_key_exists('path', $configItem)
                || !array_key_exists('value', $configItem)
                || !array_key_exists('scope', $configItem)
                || !array_key_exists('scope_id', $configItem))
                throw new \Exception('path, value, scope, scope_id values are required');

            $configResourceModel = \Mage::getResourceModel('core/config');
            $configResourceModel->saveConfig($configItem['path'], $configItem['value'], $configItem['scope'], $configItem['scope_id']);
        }

        return true;
    }
}