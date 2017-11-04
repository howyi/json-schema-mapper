<?php

namespace JsonSchemaMapper\DebugCommand;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use JsonSchemaMapper\Factory\SchemaDirFactory;
use JsonSchemaMapper\Factory\FileFactory;
use JsonSchemaMapper\Reflector\FileReflector;

class MapCommand extends Command
{
    protected function configure()
    {
        $this->setName('map');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $loader = new \Twig_Loader_Filesystem('templates');
        $twig = new \Twig_Environment($loader);

        $allFiles = FileFactory::fromAllSchemaList(
            $twig,
            'sample/generated',
            SchemaDirFactory::fromDir('sample/json', 'Json')
        );

        FileReflector::reflect($allFiles);
    }
}
