<?php

namespace Json\First\Sushi;

interface LightSushiInterface
{
    public function toJsonProperty(): array;

    public function jsonProperties(): array;

    public function addableJsonProperty(): bool;

    public function lightSushiId(): ?int;

    public function additionalProperties(): array;
}
