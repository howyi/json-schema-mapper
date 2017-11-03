<?php

namespace JsonSchemaMapper;

use JsonSchemaMapper\Factory\SchemaFactory;
use JsonSchemaMapper\Util\MapClassReflector;

class Mapper
{
    public static function map(
        string $fromDir,
        string $toDir,
        string $namespace
    ): void {

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($fromDir)
        );

        $allSchemaList = [];
        foreach ($iterator as $fileinfo) {
            if (!$fileinfo->isFile()) {
                continue;
            }
            $pathinfo = pathinfo($fileinfo->getFilename());
            if (!isset($pathinfo['extension']) or empty($pathinfo['filename'])) {
                continue;
            }
            if (strtolower($pathinfo['extension']) !== 'json') {
                continue;
            }
            $path = $fileinfo->getRealpath();
            $contents = file_get_contents($path);
            $schemaArray = json_decode($contents, true);
            if (is_null($schemaArray)) {
                continue;
            }
            $schemaList = SchemaFactory::fromSchema(
                realpath($fromDir),
                $path,
                $namespace,
                $schemaArray
            );
            $allSchemaList += $schemaList;
        }
    }
}
