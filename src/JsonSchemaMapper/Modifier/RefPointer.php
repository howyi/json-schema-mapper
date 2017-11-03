<?php

namespace JsonSchemaMapper\Modifier;

use JsonSchemaMapper\Constant\SchemaType;
use JsonSchemaMapper\Structure\NameInfo;

class RefPointer
{
    public static function getArray(
        NameInfo $nameInfo,
        array $originSchemaArray,
        string $ref
    ): array {
        $docExploded = explode('#', $ref);

        $targetDir = realpath($nameInfo->getOriginDir());
        $targetSchemaArray = [];
        $refKeyName = null;
        $refPath = null;
        for ($i = 0; $i < count($docExploded); $i++) {
            $r = $docExploded[$i];
            $isPath = (0 === $i % 2);
            if ($isPath) {
                if (empty($r)) {
                    $targetSchemaArray = $originSchemaArray;
                    continue;
                }
                $realPath = realpath($targetDir . DIRECTORY_SEPARATOR . $r);
                $targetDir = pathinfo($realPath)['dirname'];
                $refPath = $realPath;
                $contents = file_get_contents($realPath);
                $targetSchemaArray = json_decode($contents, true);
                continue;
            }

            if (!$isPath) {
                if (empty($r)) {
                    continue;
                }
                $keyExploded = explode('/', $r);
                for ($i = 1; $i < count($keyExploded); $i++) {
                    $refKeyName = $keyExploded[$i];
                    $targetSchemaArray = $targetSchemaArray[$keyExploded[$i]];
                }
            }
        }

        $targetSchemaArray['refTitle'] = Detector::classComment($nameInfo, $targetSchemaArray);
        $isLocal = $targetDir === realpath($nameInfo->getOriginDir());
        $isSelf = '#' === $ref;
        return [$targetSchemaArray, $isLocal, $isSelf, $refKeyName, $refPath];
    }
}
