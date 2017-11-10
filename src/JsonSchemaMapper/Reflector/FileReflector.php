<?php

namespace JsonSchemaMapper\Reflector;

class FileReflector
{
    public static function reflect(string $toDir, array $allFiles): void
    {
        self::deleteRecursive($toDir);
        clearstatcache();
        mkdir($toDir, 0777, true);
        clearstatcache();
        foreach ($allFiles as $filePath => $content) {
            $dirPath = dirname($filePath);
            if (!file_exists($dirPath)) {
                mkdir($dirPath, 0777, true);
                clearstatcache();
            }
            file_put_contents($filePath, $content);
            clearstatcache();
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
                clearstatcache();
            }
            if ($fileInfo->isDir()) {
                self::deleteRecursive($fileInfo->getPathName());
            }
        }
        clearstatcache();
        rmdir($dir);
    }
}
