<?php

namespace Json\First\Sushi;

use Json\Osakana;
use Json\Second\AnotherSushi\AnotherSushiInterface;

interface SushiInterface
{
    public function toJsonArray(): array;

    public function jsonProperties(): array;

    public function allowAdditionalProperties(): bool;

    public function sushiId(): int;

    public function sushiName(): string;

    public function eatable(): bool;

    public function length(): ?float;

    public function osakanaType(): Osakana;

    public function sushiType(): ?SushiType;

    public function sushiType2(): ?SushiType2;

    public function sushiType3(): ?SushiType2;

    public function childSushi(): ?SushiInterface;

    public function nextSushi(): ?AnotherSushiInterface;

    public function expirationDate(): \DateTimeInterface;

    public function lightSushi(): ?LightSushiInterface;

    public function additionalProperties(): array;
}
