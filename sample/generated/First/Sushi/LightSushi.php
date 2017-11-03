<?php

namespace Json\First\Sushi;

class LightSushi implements LightSushiInterface, \JsonSerializable
{
    use LightSushiTrait;

    protected $lightSushiId;
    protected $additionalProperties;

    public function __construct(
        ?int $lightSushiId,
        array $additionalProperties = []
    ) {
        $this->lightSushiId = $lightSushiId;
        $this->additionalProperties = $additionalProperties;
    }

    public function lightSushiId(): ?int
    {
        return $this->lightSushiId;
    }

    public function additionalProperties(): array
    {
        return $this->additionalProperties;
    }
}
