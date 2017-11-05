<?php

namespace JsonSchemaMapper\Modifier;

use JsonSchemaMapper\Constant\SchemaType;
use JsonSchemaMapper\Structure\NameInfo;

class Detector
{
    public static function schemaType(array $schemaArray): SchemaType
    {
        if (isset($schemaArray['enum'])) {
            return SchemaType::ENUM();
        }

        if (isset($schemaArray['type'])) {
            if (is_array($schemaArray['type'])) {
                return SchemaType::MIXED();
            }
            switch ($schemaArray['type']) {
                case 'null':
                    return SchemaType::NULL();
                case 'boolean':
                    return SchemaType::BOOLEAN();
                case 'object':
                    return SchemaType::OBJECT();
                case 'array':
                    return SchemaType::ARRAY();
                case 'integer':
                    return SchemaType::INTEGER();
                case 'number':
                    return SchemaType::NUMBER();
                case 'string':
                    if (isset($schemaArray['format']) and $schemaArray['format'] === 'date-time') {
                        return SchemaType::DATETIME();
                    }
                    return SchemaType::STRING();
            }
        }

        foreach (SchemaType::getKeySchemaTypeMap() as $schemaTypeValue => $keys) {
            foreach ($keys as $key) {
                if (isset($schemaArray[$key])) {
                    return SchemaType::memberByValue($schemaTypeValue);
                }
            }
        }

        return SchemaType::UNDEFINED();
    }

    public static function classComment(
        NameInfo $nameInfo,
        array $schemaArray
    ): string {
        return self::comment($schemaArray) ?? $nameInfo->getClassName();
    }

    public static function comment(array $schemaArray): string
    {
        return $schemaArray['refTitle'] ?? $schemaArray['title'] ?? $schemaArray['description'] ?? '';
    }
}
