<?php

namespace Json\First\Sushi;

use Json\Osakana;
use Json\Second\AnotherSushi\AnotherSushiInterface;

class Sushi implements SushiInterface, \JsonSerializable
{
    use SushiTrait;

    protected $sushiId;
    protected $sushiName;
    protected $eatable;
    protected $length;
    protected $osakanaType;
    protected $sushiType;
    protected $sushiType2;
    protected $sushiType3;
    protected $childSushi;
    protected $nextSushi;
    protected $expirationDate;
    protected $lightSushi;
    protected $additionalProperties;

    public function __construct(
        int $sushiId,
        string $sushiName,
        bool $eatable,
        ?float $length,
        Osakana $osakanaType,
        ?SushiType $sushiType,
        ?SushiType2 $sushiType2,
        ?SushiType2 $sushiType3,
        ?SushiInterface $childSushi,
        ?AnotherSushiInterface $nextSushi,
        \DateTimeInterface $expirationDate,
        ?LightSushiInterface $lightSushi,
        array $additionalProperties = []
    ) {
        $this->sushiId = $sushiId;
        $this->sushiName = $sushiName;
        $this->eatable = $eatable;
        $this->length = $length;
        $this->osakanaType = $osakanaType;
        $this->sushiType = $sushiType;
        $this->sushiType2 = $sushiType2;
        $this->sushiType3 = $sushiType3;
        $this->childSushi = $childSushi;
        $this->nextSushi = $nextSushi;
        $this->expirationDate = $expirationDate;
        $this->lightSushi = $lightSushi;
        $this->additionalProperties = $additionalProperties;
    }

    public function sushiId(): int
    {
        return $this->sushiId;
    }

    public function sushiName(): string
    {
        return $this->sushiName;
    }

    public function eatable(): bool
    {
        return $this->eatable;
    }

    public function length(): ?float
    {
        return $this->length;
    }

    public function osakanaType(): Osakana
    {
        return $this->osakanaType;
    }

    public function sushiType(): ?SushiType
    {
        return $this->sushiType;
    }

    public function sushiType2(): ?SushiType2
    {
        return $this->sushiType2;
    }

    public function sushiType3(): ?SushiType2
    {
        return $this->sushiType3;
    }

    public function childSushi(): ?SushiInterface
    {
        return $this->childSushi;
    }

    public function nextSushi(): ?AnotherSushiInterface
    {
        return $this->nextSushi;
    }

    public function expirationDate(): \DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function lightSushi(): ?LightSushiInterface
    {
        return $this->lightSushi;
    }

    public function additionalProperties(): array
    {
        return $this->additionalProperties;
    }
}
