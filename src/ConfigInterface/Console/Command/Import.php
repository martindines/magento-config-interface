<?php

namespace ConfigInterface\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as CommandBase;
use RuntimeException;

class Import extends CommandBase
{
    protected function configure()
    {
        $this->setName('import')
            ->setDescription('Import configuration in YAML format')
            ->addArgument(
                'file',
                InputArgument::REQUIRED,
                'Path to YAML file'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');

        if (!is_readable($file))
            throw new RuntimeException('File is not readable');

        $yaml = file_get_contents($file);

        $result = $this->getApplication()->getMasterApplication()->importConfigFromYaml($yaml);

        $outputResponse = $result ? 'Import successful' : 'Import unsuccessful';

        $output->writeln($outputResponse);
    }
}