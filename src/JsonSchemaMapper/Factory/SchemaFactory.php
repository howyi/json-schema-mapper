<?php

namespace JsonSchemaMapper\Factory;

use JsonSchemaMapper\Modifier\Detector;
use JsonSchemaMapper\Structure\NameInfo;
use JsonSchemaMapper\Structure\TypeInfo;
use JsonSchemaMapper\Constant\SchemaType;

class SchemaFactory
{
    public static function fromSchema(
        string $baseDir,
        string $path,
        string $namespace,
        array $schemaArray
    ): array {
        $relativePath = str_replace([$baseDir . DIRECTORY_SEPARATOR, '\\'], ['', '/'], $path);
        $nameInfo = new NameInfo($baseDir, $relativePath, $namespace);

        $type = Detector::schemaType($schemaArray);

        if (!$type->isClassType()) {
            return [];
        }

        switch ($type->value()) {
            case SchemaType::ENUM:
                return [EnumSchemaFactory::fromSchema(
                    $nameInfo,
                    $schemaArray
                )];
                break;
            case SchemaType::OBJECT:
                return ObjectSchemaFactory::fromSchema(
                    $nameInfo,
                    $schemaArray
                );
                break;
        }
    }
}
