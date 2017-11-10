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
        if (!$this->allowAdditionalProperties()) {
            return $array;
        }
        foreach ($this->additionalProperties() as $key => $value) {
            $array[$key] = Getter::value($value);
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
