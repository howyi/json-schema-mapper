<?php

namespace JsonSchemaMapper\Structure;

class EnumSchema
{
    private $schemaInfo;
    private $values;

    /**
     * @param [] $values
     */
    public function __construct(
        SchemaInfo $schemaInfo,
        array $values
    ) {
        $this->schemaInfo = $schemaInfo;
        $this->values = $values;
    }

    public function schemaInfo()
    {
        return $this->schemaInfo;
    }

    public function path($toDir)
    {
        return sprintf(
            '%s/%s/%s.php',
            $toDir,
            $this->schemaInfo->relativeDir(),
            $this->schemaInfo->name()
        );
    }

    public function qualfiedName()
    {
        return sprintf(
            '%s\%s',
            $this->schemaInfo->namespace(),
            $this->schemaInfo->name()
        );
    }

    public function values()
    {
        return $this->values;
    }
}
