<?php

namespace JsonSchemaMapper\DebugCommand;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use JsonSchemaMapper\Mapper;

class MapCommand extends Command
{
    protected function configure()
    {
        $this->setName('map');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Mapper::map(
            'build/json',
            'src/JsonSchemaMapper/Expected',
            'JsonSchemaMapper\Expected',
            'templates'
        );
    }
}
