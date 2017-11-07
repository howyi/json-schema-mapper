<?php

namespace JsonSchemaMapper\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use JsonSchemaMapper\Mapper;

class MapCommand extends Command
{
    protected function configure()
    {
        $this
        ->setName('map')
        ->setDescription('JSON Schema dir map to PHP Classes.')
        ->addArgument(
          'jsonDir',
          InputArgument::REQUIRED,
          'JSON Schame directory'
        )
        ->addArgument(
          'phpDir',
          InputArgument::REQUIRED,
          'Map destination directory'
        )
        ->addArgument(
          'namespace',
          InputArgument::REQUIRED,
          'Map PHP namespace'
        )
        ->addArgument(
          'template',
          InputArgument::OPTIONAL,
          'PHP templates directory',
          __DIR__ . '/../../../templates'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Mapper::map(
            $input->getArgument('jsonDir'),
            $input->getArgument('phpDir'),
            $input->getArgument('namespace'),
            $input->getArgument('template')
        );
    }
}
