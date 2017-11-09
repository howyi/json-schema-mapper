<?php

namespace Json\Second\AnotherSushi;

trait AnotherSushiTrait
{
    use \JsonSchemaMapper\ObjectTrait;

    public function jsonProperties(): array
    {
        return [
            'anotherSushiId',
            'sushiName',
            'eatable',
            'length',
            'osakanaType',
            'sushiType',
            'childSushi',
            'expirationDate',
        ];
    }

    public function allowAdditionalProperties(): bool
    {
        return false;
    }
}
