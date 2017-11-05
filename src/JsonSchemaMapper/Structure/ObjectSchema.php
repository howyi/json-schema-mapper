<?php

namespace JsonSchemaMapper\Structure;

class ObjectSchema
{
    private $schemaInfo;
    private $useList;
    private $typeList;
    private $addableProperties;

    /**
     * @param [] $values
     */
    public function __construct(
        SchemaInfo $schemaInfo,
        array $useList,
        array $typeList,
        bool $addableProperties
    ) {
        $this->schemaInfo = $schemaInfo;
        $this->useList = $useList;
        $this->typeList = $typeList;
        $this->addableProperties = $addableProperties;
    }

    public function schemaInfo()
    {
        return $this->schemaInfo;
    }

    public function useList()
    {
        return $this->useList;
    }

    public function constructParam()
    {
        $params = [];
        for ($i = 0; $i < count($this->typeList); $i++) {
            $type = $this->typeList[$i];

            if (empty($type->hint())) {
                $param = '$' . $type->name();
            } else {
                $param =  $type->hint() . ' $' . $type->name();
            }

            if (($i + 1 !== count($this->typeList)) or ($this->addableProperties())) {
                $param .= ',';
            }
            $params[] = $param;
        }
        if ($this->addableProperties()) {
            $params[] = 'array $additionalProperties = []';
        }
        return $params;
    }

    public function typeList()
    {
        return $this->typeList;
    }

    public function addableProperties()
    {
        return $this->addableProperties;
    }

    public function corePath($toDir)
    {
        return sprintf(
            '%s/%s/%s.php',
            $toDir,
            $this->schemaInfo->relativeDir(),
            $this->schemaInfo->name()
        );
    }

    public function interfacePath($toDir)
    {
        return sprintf(
            '%s/%s/%sInterface.php',
            $toDir,
            $this->schemaInfo->relativeDir(),
            $this->schemaInfo->name()
        );
    }

    public function traitPath($toDir)
    {
        return sprintf(
            '%s/%s/%sTrait.php',
            $toDir,
            $this->schemaInfo->relativeDir(),
            $this->schemaInfo->name()
        );
    }
}
