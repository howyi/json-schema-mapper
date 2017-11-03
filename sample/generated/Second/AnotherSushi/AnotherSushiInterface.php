<?php

namespace Json\Second\AnotherSushi;

use Json\Osakana;

interface AnotherSushiInterface
{
    public function toJsonProperty(): array;

    public function jsonProperties(): array;

    public function addableJsonProperty(): bool;

    public function anotherSushiId(): ?int;

    public function sushiName(): string;

    public function eatable(): bool;

    public function length(): ?float;

    public function osakanaType(): Osakana;

    public function sushiType(): ?SushiType;

    public function childSushi(): ?AnotherSushiInterface;

    public function expirationDate(): \DateTimeInterface;
}
