<?php

namespace JsonSchemaMapper\Structure;

class SchemaInfo
{
    private $relativeDir;
    private $namespace;
    private $name;
    private $classComment;

    /**
     * @param [] $values
     */
    public function __construct(
        string $relativeDir,
        string $namespace,
        string $name,
        string $classComment
    ) {
        $this->relativeDir = $relativeDir;
        $this->namespace = $namespace;
        $this->name = $name;
        $this->classComment = $classComment;
    }

    public function relativeDir()
    {
        return $this->relativeDir;
    }

    public function namespace()
    {
        return $this->namespace;
    }

    public function name()
    {
        return $this->name;
    }

    public function classComment()
    {
        return $this->classComment;
    }
}
