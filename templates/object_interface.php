<?php

namespace {{ schema.schemaInfo.namespace }};

{% for value in schema.interfaceUseList %}
use {{ value }};
{% endfor %}

interface {{ schema.schemaInfo.name }}Interface extends JsonArrayAccess, \JsonSerializable
{
    public function toJsonArray(): array;

    public function jsonProperties(): array;

    public function allowAdditionalProperties(): bool;
{% for type in schema.typeList %}

    public function {{ type.name }}(){{ type.returnHint }};
{% endfor %}
{% if schema.addableProperties %}

    public function additionalProperties(): array;
{% endif %}
}
