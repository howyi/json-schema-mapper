<?php

namespace JsonSchemaMapper\Reflector;

class FileReflector
{
    public static function reflect(string $toDir, array $allFiles): void
    {
        if (file_exists($toDir)) {
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($toDir)
            );
            foreach ($iterator as $fileinfo) {
                if ($fileinfo->isFile()) {
                    unlink($fileinfo->getPathName());
                }
            }
            // TODO DIRECTORY DELETE
        } else {
            mkdir($toDir, 0777, true);
        }
        foreach ($allFiles as $filePath => $content) {
            $dirPath = dirname($filePath);
            if (!file_exists($dirPath)) {
                mkdir($dirPath, 0777, true);
            }
            file_put_contents($filePath, $content);
        }
    }
}
