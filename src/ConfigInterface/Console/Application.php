<?php

namespace ConfigInterface\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Application extends BaseApplication
{
    protected $masterApplication;

    public function setMasterApplication(\ConfigInterface\Application $application)
    {
        $this->masterApplication = $application;
    }

    public function getMasterApplication()
    {
        return $this->masterApplication;
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->add(new Command\Export);
        $this->add(new Command\Import);

        parent::doRun($input, $output);
    }
}