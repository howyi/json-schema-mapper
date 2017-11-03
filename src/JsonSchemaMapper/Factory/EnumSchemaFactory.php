<?php

namespace JsonSchemaMapper\Factory;

use JsonSchemaMapper\Modifier\Detector;
use JsonSchemaMapper\Structure\EnumSchema;
use JsonSchemaMapper\Structure\NameInfo;
use JsonSchemaMapper\Structure\SchemaInfo;

class EnumSchemaFactory
{
    private const ENUMERABLE_TYPE_METHODS = [
        'null'    => 'is_null',
        'boolean' => 'is_bool',
        'integer' => 'is_int',
        'number'  => 'is_float',
        'string'  => 'is_string',
    ];

    public static function fromSchema(NameInfo $nameInfo, array $schemaArray): EnumSchema
    {
        return new EnumSchema(
            new SchemaInfo(
                $nameInfo->getDestinationRelativeDir(),
                $nameInfo->getEnumNamespace(),
                $nameInfo->getClassName(),
                Detector::classComment($nameInfo, $schemaArray)
            ),
            self::generateFilteredValues($schemaArray)
        );
    }

    public static function fromPropertySchema(
        NameInfo $nameInfo,
        array $originSchemaArray,
        string $targetClassName,
        array $targetSchemaArray,
        array &$localSchemaList
    ): void {
        $localSchemaList[] = new EnumSchema(
            new SchemaInfo(
                $nameInfo->getObjectRelativeDir(),
                $nameInfo->getObjectNamespace(),
                $targetClassName,
                Detector::classComment($nameInfo, $targetSchemaArray)
            ),
            self::generateFilteredValues($targetSchemaArray)
        );
    }

    private static function generateFilteredValues(array $schemaArray): array
    {
        $values = [];
        $enumArray = $schemaArray['enum'];
        if (isset($schemaArray['enumNames'])) {
            // Unofficial spec.
            // https://github.com/json-schema/json-schema/wiki/enumNames-(v5-proposal)
            $names = $schemaArray['enumNames'];
            $i = 0;
            foreach ($enumArray as $value) {
                $key = isset($names[$i]) ? $names[$i] : $value;
                $values[$key] = $value;
                $i++;
            }
        } elseif (isset($schemaArray['choices'])) {
            // Unofficial spec.
            // https://github.com/json-schema/json-schema/wiki/choices-(v5-proposal-to-enhance-enum)
            $choices = [];
            foreach ($schemaArray['choices'] as [$value, $key]) {
                $choices[$value] = $key;
            }
            foreach ($enumArray as $value) {
                $key = isset($choices[$value]) ? $choices[$value] : $value;
                $values[$key] = $value;
            }
        } elseif (isset($schemaArray['options'])) {
            // Unofficial spec.
            // http://d.hatena.ne.jp/m-hiyama/20090618/1245292404
            $options = [];
            foreach ($schemaArray['options'] as $option) {
                if ((is_null($option['value']) or isset($option['value'])) and isset($option['label'])) {
                    $options[$option['value']] = $option['label'];
                }
            }
            foreach ($enumArray as $value) {
                $key = isset($options[$value]) ? $options[$value] : (string) $value;
                $values[$key] = $value;
            }
        } else {
            $values = array_combine($enumArray, $enumArray);
        }

        $filterTypeMethods = [];
        if (isset($schemaArray['type'])) {
            $filterTypeMethods = self::ENUMERABLE_TYPE_METHODS;
            if (is_array($schemaArray['type'])) {
                $diff = $schemaArray['type'];
            } else {
                $diff = [$schemaArray['type']];
            }
            $filterTypeMethods = array_diff_key($filterTypeMethods, array_flip($diff));
        }

        $filteredValues = [];

        $i = 0;
        foreach ($values as $key => $value) {
            foreach ($filterTypeMethods as $type => $method) {
                if ($method($value)) {
                    continue 2;
                }
            }

            $key = preg_replace('/[^a-zA-Z0-9_\x7f-\xff]/u', '_', $key);

            if (is_numeric($key) or is_float($key)) {
                $key = "E_$key";
            }
            $key = preg_replace('/[^a-zA-Z0-9_\x7f-\xff]/u', '_', $key);

            if (is_string($value)) {
                $value = "'$value'";
            }

            if (is_null($value)) {
                $value = 'null';
            }

            $key = strtoupper($key);
            if (isset($filteredValues[$key])) {
                $key = "{$key}_{$i}";
                $i++;
            }
            $filteredValues[$key] = $value;
        }

        return $filteredValues;
    }
}
