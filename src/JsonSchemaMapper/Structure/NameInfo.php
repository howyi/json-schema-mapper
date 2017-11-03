<?php

namespace JsonSchemaMapper\Structure;

class NameInfo
{
    private $baseDir;
    private $originRelativePath;
    private $baseNamespace;

    /**
     * @param [] $values
     */
    public function __construct(
        string $baseDir,
        string $originRelativePath,
        string $baseNamespace
    ) {
        $this->baseDir = $baseDir;
        $this->originRelativePath = $originRelativePath;
        $this->baseNamespace = $baseNamespace;
    }

    public function getBaseDir(): string
    {
        return $this->baseDir;
    }

    public function getOriginDir(): string
    {
        return $this->getBaseDir() . DIRECTORY_SEPARATOR . $this->getOriginRelativeDir();
    }

    public function getOriginRelativeDir(): string
    {
        $pathinfo = pathinfo($this->originRelativePath);
        return '.' === $pathinfo['dirname'] ? '' : $pathinfo['dirname'];
    }

    public function getDestinationRelativeDir(): string
    {
        $pathinfo = pathinfo($this->originRelativePath);
        if ('.' === $pathinfo['dirname']) {
            return '';
        }
        $explodedNames = explode('/', $this->originRelativePath);
        unset($explodedNames[count($explodedNames) - 1]);
        $nameArray = [];
        foreach ($explodedNames as $name) {
            $nameArray[] = ucfirst($name);
        }
        return implode('/', $nameArray);
    }

    public function getObjectRelativeDir(): string
    {
        return $this->getDestinationRelativeDir() . '/' . $this->getClassName();
    }

    public function getEnumNamespace(): string
    {
        $explodedNames = explode('/', $this->originRelativePath);
        unset($explodedNames[count($explodedNames) - 1]);
        $nameArray = [$this->baseNamespace];
        foreach ($explodedNames as $name) {
            $nameArray[] = ucfirst($name);
        }
        return implode('\\', $nameArray);
    }

    public function getObjectNamespace(): string
    {
        return $this->getEnumNamespace() . '\\' . $this->getClassName();
    }

    public function getClassName(): string
    {
        $pathinfo = pathinfo($this->originRelativePath);
        return ucfirst($pathinfo['filename']);
    }

    public function pathToEnumName(string $path): string
    {
        $path = str_replace([$this->getBaseDir() . DIRECTORY_SEPARATOR, '\\'], ['', '/'], $path);
        $explodedNames = explode('/', $path);
        unset($explodedNames[count($explodedNames) - 1]);
        $nameArray = [$this->baseNamespace];
        foreach ($explodedNames as $name) {
            $nameArray[] = ucfirst($name);
        }
        $pathinfo = pathinfo($path);
        $nameArray[] = ucfirst($pathinfo['filename']);
        return implode('\\', $nameArray);
    }

    public function pathToInterfaceName(string $path): string
    {
        $path = str_replace([$this->getBaseDir() . DIRECTORY_SEPARATOR, '\\'], ['', '/'], $path);
        $explodedNames = explode('/', $path);
        unset($explodedNames[count($explodedNames) - 1]);
        $nameArray = [$this->baseNamespace];
        foreach ($explodedNames as $name) {
            $nameArray[] = ucfirst($name);
        }
        $pathinfo = pathinfo($path);
        $nameArray[] = ucfirst($pathinfo['filename']);
        $nameArray[] = ucfirst($pathinfo['filename']) . 'Interface';
        return implode('\\', $nameArray);
    }
}
