<?php

namespace JsonSchemaMapper\Reflector;

class FileReflector
{
    public static function reflect(array $allFiles): void
    {
        foreach ($allFiles as $filePath => $content) {
            $dirPath = dirname($filePath);
            if (!file_exists($dirPath)) {
                mkdir($dirPath, 0777, true);
            }
            file_put_contents($filePath, $content);
        }
    }
}
