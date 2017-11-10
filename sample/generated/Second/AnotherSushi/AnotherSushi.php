<?php

namespace Json\Second\AnotherSushi;

use Json\Osakana;

class AnotherSushi implements AnotherSushiInterface
{
    use AnotherSushiTrait;

    protected $anotherSushiId;
    protected $sushiName;
    protected $eatable;
    protected $length;
    protected $osakanaType;
    protected $sushiType;
    protected $childSushi;
    protected $expirationDate;

    public function __construct(
        ?int $anotherSushiId,
        string $sushiName,
        bool $eatable,
        ?float $length,
        Osakana $osakanaType,
        ?SushiType $sushiType,
        ?AnotherSushiInterface $childSushi,
        \DateTimeInterface $expirationDate
    ) {
        $this->anotherSushiId = $anotherSushiId;
        $this->sushiName = $sushiName;
        $this->eatable = $eatable;
        $this->length = $length;
        $this->osakanaType = $osakanaType;
        $this->sushiType = $sushiType;
        $this->childSushi = $childSushi;
        $this->expirationDate = $expirationDate;
    }

    public function anotherSushiId(): ?int
    {
        return $this->anotherSushiId;
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

    public function childSushi(): ?AnotherSushiInterface
    {
        return $this->childSushi;
    }

    public function expirationDate(): \DateTimeInterface
    {
        return $this->expirationDate;
    }
}
