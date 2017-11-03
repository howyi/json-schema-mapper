<?php

namespace JsonSchemaMapper\Factory;

use JsonSchemaMapper\Structure\EnumSchema;
use JsonSchemaMapper\Structure\ObjectSchema;
use Memio\Model\File;
use Memio\Model\Object;
use Memio\Model\Property;
use Memio\Model\Method;
use Memio\Model\Argument;
use Memio\Model\Constant;
use Memio\Model\Contract;

class FileFactory
{
    public static function fromAllSchemaList(
        \Twig_Environment $twig,
        string $toDir,
        array $allSchemaList,
        array $additionalValues = []
    ): array {
        $allFiles = [];
        foreach ($allSchemaList as $schema) {
            $files = [];
            if ($schema instanceof EnumSchema) {
                $files = self::fromEnumSchema($twig, $toDir, $schema, $additionalValues);
            } elseif ($schema instanceof ObjectSchema) {
                $files = self::fromObjectSchema($twig, $toDir, $schema, $additionalValues);
            }
            $allFiles = array_merge(
                $allFiles,
                $files
            );
        }

        return $allFiles;
    }

    public static function fromEnumSchema(
        \Twig_Environment $twig,
        string $toDir,
        EnumSchema $schema,
        array $additionalValues = []
    ): array {
        $rendered = $twig->render(
            'enum.php',
            array_merge(
                ['schema' => $schema],
                $additionalValues
            )
        );

        return [$schema->path($toDir) => $rendered];
    }

    public static function fromObjectSchema(
        \Twig_Environment $twig,
        string $toDir,
        ObjectSchema $schema,
        array $additionalValues = []
    ): array {
        $coreRendered = $twig->render(
            'object_core.php',
            array_merge(
                ['schema' => $schema],
                $additionalValues
            )
        );

        $interfaceRendered = $twig->render(
            'object_interface.php',
            array_merge(
                ['schema' => $schema],
                $additionalValues
            )
        );

        $traitRendered = $twig->render(
            'object_trait.php',
            array_merge(
                ['schema' => $schema],
                $additionalValues
            )
        );

        return [
            $schema->corePath($toDir)      => $coreRendered,
            $schema->interfacePath($toDir) => $interfaceRendered,
            $schema->traitPath($toDir)     => $traitRendered,
        ];
    }
}
