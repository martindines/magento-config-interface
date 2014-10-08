<?php

namespace ConfigInterface;

class Utilities
{
    /**
     * @param \Varien_Data_Collection $collection
     * @return array
     */
    static function collectionToArray(\Varien_Data_Collection $collection)
    {
        $collectionAsArray = array();

        foreach ($collection as $item) {
            array_push($collectionAsArray, $item->getData());
        }

        return $collectionAsArray;
    }
}
