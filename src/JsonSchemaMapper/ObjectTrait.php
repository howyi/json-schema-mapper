<?php

namespace JsonSchemaMapper;

trait ObjectTrait
{
    /**
     * @return array
     */
    public function toJsonArray(): array
    {
        $array = [];
        foreach ($this->jsonProperties() as $method) {
            $value = $this->$method();
            if (!isset($value)) {
                continue;
            }
            $array[$method] = Getter::value($value);
        }
        if ($this->addableJsonProperty()) {
            $array += $this->additionalProperties();
        }
        return $array;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toJsonArray();
    }
}
