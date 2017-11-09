<?php

namespace JsonSchemaMapper\Reflector;

class FileReflector
{
    public static function reflect(string $toDir, array $allFiles): void
    {
        self::deleteRecursive($toDir);
        mkdir($toDir, 0777, true);
        foreach ($allFiles as $filePath => $content) {
            $dirPath = dirname($filePath);
            if (!file_exists($dirPath)) {
                mkdir($dirPath, 0777, true);
            }
            file_put_contents($filePath, $content);
        }
    }

    public static function deleteRecursive(string $dir): void
    {
        if (!file_exists($dir)) {
            return;
        }
        foreach (new \DirectoryIterator($dir) as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue;
            }
            if ($fileInfo->isFile() or $fileInfo->isLink()) {
                unlink($fileInfo->getPathName());
            }
            if ($fileInfo->isDir()) {
                self::deleteRecursive($fileInfo->getPathName());
            }
        }
        rmdir($dir);
    }
}
