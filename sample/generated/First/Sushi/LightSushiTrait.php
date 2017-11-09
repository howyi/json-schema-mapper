<?php

namespace Json\First\Sushi;

trait LightSushiTrait
{
    use \JsonSchemaMapper\ObjectTrait;

    public function jsonProperties(): array
    {
        return [
            'lightSushiId',
        ];
    }

    public function allowAdditionalProperties(): bool
    {
        return true;
    }
}
