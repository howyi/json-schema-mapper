<?php

namespace Json\First\Sushi;

trait SushiTrait
{
    use \JsonSchemaMapper\ObjectTrait;

    public function jsonProperties(): array
    {
        return [
            'sushiId',
            'sushiName',
            'eatable',
            'length',
            'osakanaType',
            'sushiType',
            'sushiType2',
            'sushiType3',
            'childSushi',
            'nextSushi',
            'expirationDate',
            'lightSushi',
        ];
    }

    public function allowAdditionalProperties(): bool
    {
        return true;
    }
}
