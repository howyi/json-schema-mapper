<?php

namespace Json\First\Sushi;

use JsonSchemaMapper\JsonArrayAccess;

interface LightSushiInterface extends JsonArrayAccess, \JsonSerializable
{
    public function toJsonArray(): array;

    public function jsonProperties(): array;

    public function allowAdditionalProperties(): bool;

    public function lightSushiId(): ?int;

    public function additionalProperties(): array;
}
