<?php

namespace JsonSchemaMapper\Factory;

use JsonSchemaMapper\Structure\ObjectSchema;
use JsonSchemaMapper\Structure\NameInfo;
use JsonSchemaMapper\Structure\TypeInfo;
use JsonSchemaMapper\Structure\SchemaInfo;
use JsonSchemaMapper\Modifier\Detector;
use JsonSchemaMapper\Modifier\RefPointer;
use JsonSchemaMapper\Constant\SchemaType;

class ObjectSchemaFactory
{
    public static function fromSchema(NameInfo $nameInfo, array $schemaArray): array
    {
        $properties = [];
        $localSchemaList = [];
        self::fromPropertySchema(
            $nameInfo,
            $schemaArray,
            $nameInfo->getClassName(),
            $schemaArray,
            $localSchemaList
        );
        return $localSchemaList;
    }

    public static function fromPropertySchema(
        NameInfo $nameInfo,
        array $originSchemaArray,
        string $targetClassName,
        array $targetSchemaArray,
        array &$localSchemaList
    ): void {
        $requiredKeys = $targetSchemaArray['required'] ?? [];

        $typeInfoList = [];
        $useList = [];
        if (isset($targetSchemaArray['properties'])) {
            foreach ($targetSchemaArray['properties'] as $key => $propertySchemaArray) {
                $phpType = '';
                $isLocal = true;
                $refPath = null;
                $refKeyName = null;
                $isSelf = false;
                if (isset($propertySchemaArray['$ref'])) {
                    $ref = $propertySchemaArray['$ref'];
                    [$refArray, $isLocal, $isSelf, $refKeyName, $refPath] = RefPointer::getArray(
                        $nameInfo,
                        $originSchemaArray,
                        $ref
                    );
                    $propertySchemaArray += $refArray;
                }

                if (is_array($propertySchemaArray)) {
                    $type = Detector::schemaType($propertySchemaArray);
                    $comment = Detector::comment($propertySchemaArray);
                } else {
                    $type = SchemaType::UNDEFINED();
                    $comment = '';
                }

                if ($type->isSingleType()) {
                    $phpType = $type->getPhpType();
                } elseif ($isLocal and is_null($refPath)) {
                    if (SchemaType::ENUM === $type->value()) {
                        if (empty($refKeyName)) {
                            $refKeyName = $key;
                        }
                        $phpType =  ucfirst($refKeyName);
                        EnumSchemaFactory::fromPropertySchema(
                            $nameInfo,
                            $originSchemaArray,
                            ucfirst($refKeyName),
                            $propertySchemaArray,
                            $localSchemaList
                        );
                    } elseif (SchemaType::OBJECT === $type->value()) {
                        if ($isSelf) {
                            $phpType = $targetClassName . 'Interface';
                        } else {
                            $phpType = ucfirst($key) . 'Interface';
                            self::fromPropertySchema(
                                $nameInfo,
                                $originSchemaArray,
                                ucfirst($key),
                                $propertySchemaArray,
                                $localSchemaList
                            );
                        }
                    }
                } else {
                    if (SchemaType::ENUM === $type->value()) {
                        $useList[] = $nameInfo->pathToEnumName($refPath);
                        $phpType =  ucfirst(pathinfo($refPath)['filename']);
                    } elseif (SchemaType::OBJECT === $type->value()) {
                        $useList[] = $nameInfo->pathToInterfaceName($refPath);
                        $phpType =  ucfirst(pathinfo($refPath)['filename'] . 'Interface');
                    }
                }

                $typeInfoList[] = new TypeInfo(
                    $key,
                    $phpType,
                    $comment,
                    in_array($key, $requiredKeys, true)
                );

                if ($type == SchemaType::NULL()) {
                    $useList[] = 'JsonSchemaMapper\ExistsNull';
                }
            }
        }

        $useList = array_unique($useList);

        $addablePropertires = $targetSchemaArray['additionalProperties'] ?? true;

        $localSchemaList[] = new ObjectSchema(
            new SchemaInfo(
                $nameInfo->getObjectRelativeDir(),
                $nameInfo->getObjectNamespace(),
                $targetClassName,
                Detector::classComment($nameInfo, $targetSchemaArray)
            ),
            $useList,
            $typeInfoList,
            $addablePropertires
        );
    }
}
