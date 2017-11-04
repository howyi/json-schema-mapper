<?php

namespace {{ schema.schemaInfo.namespace }};

{% if schema.useList|length >= 1 %}
{% for value in schema.useList %}
use {{ value }};
{% endfor %}

{% endif %}
interface {{ schema.schemaInfo.name }}Interface
{
    public function toJsonArray(): array;

    public function jsonProperties(): array;

    public function addableJsonProperty(): bool;
{% for type in schema.typeList %}

    public function {{ type.name }}(): {{ type.hint }};
{% endfor %}
{% if schema.addableProperties %}

    public function additionalProperties(): array;
{% endif %}
}
