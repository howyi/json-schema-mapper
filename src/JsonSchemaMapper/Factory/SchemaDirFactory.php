<?php

namespace JsonSchemaMapper\Factory;

use Howyi\Evi;

class SchemaDirFactory
{
    public static function fromDir(
        string $fromDir,
        string $namespace
    ): array {
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
            $schemaArray = Evi::parse($path, true, null);
            if (is_null($schemaArray)) {
                continue;
            }
            $schemaList = SchemaFactory::fromSchema(
                realpath($fromDir),
                $path,
                $namespace,
                $schemaArray
            );
            $allSchemaList = array_merge($allSchemaList, $schemaList);
        }

        return $allSchemaList;
    }
}
