<?php

namespace ConfigInterface\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as CommandBase;

class Export extends CommandBase
{
    protected function configure()
    {
        $this->setName('export')
            ->setDescription('Export configuration in YAML format');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $yaml = $this->getApplication()->getMasterApplication()->getConfigAsYaml();
        $output->writeln($yaml);
    }
}