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
        string $templateDir,
        array $additionalValues = []
    ): void {
        $loader = new \Twig_Loader_Filesystem($templateDir);
        $twig = new \Twig_Environment($loader);

        $allFiles = FileFactory::fromAllSchemaList(
            $twig,
            $toDir,
            SchemaDirFactory::fromDir($fromDir, $namespace),
            $additionalValues
        );

        FileReflector::reflect($toDir, $allFiles);
    }
}
