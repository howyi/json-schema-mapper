<?php

namespace Json\Second\AnotherSushi;

use JsonSchemaMapper\JsonArrayAccess;
use Json\Osakana;

interface AnotherSushiInterface extends JsonArrayAccess, \JsonSerializable
{
    public function toJsonArray(): array;

    public function jsonProperties(): array;

    public function allowAdditionalProperties(): bool;

    public function anotherSushiId(): ?int;

    public function sushiName(): string;

    public function eatable(): bool;

    public function length(): ?float;

    public function osakanaType(): Osakana;

    public function sushiType(): ?SushiType;

    public function childSushi(): ?AnotherSushiInterface;

    public function expirationDate(): \DateTimeInterface;
}
