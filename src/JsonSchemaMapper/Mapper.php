<?php

namespace JsonSchemaMapper;

use JsonSchemaMapper\Factory\SchemaDirFactory;
use JsonSchemaMapper\Factory\FileFactory;
use JsonSchemaMapper\Reflector\FileReflector;

class Mapper
{
    public static function map(
        string $fromDir,
        string $toDir,
        string $namespace,
        string $templateDir
    ): void {
        $loader = new \Twig_Loader_Filesystem($templateDir);
        $twig = new \Twig_Environment($loader);

        $allFiles = FileFactory::fromAllSchemaList(
            $twig,
            $toDir,
            SchemaDirFactory::fromDir($fromDir, $namespace)
        );

        FileReflector::reflect($toDir, $allFiles);
    }
}
