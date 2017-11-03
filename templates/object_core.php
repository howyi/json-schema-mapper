<?php

namespace {{ schema.schemaInfo.namespace }};

{% if schema.useList|length >= 1 %}
{% for value in schema.useList %}
use {{ value }};
{% endfor %}

{% endif %}
class {{ schema.schemaInfo.name }} implements {{ schema.schemaInfo.name }}Interface, \JsonSerializable
{
    use {{ schema.schemaInfo.name }}Trait;

{% for type in schema.typeList %}
    protected ${{ type.name }};
{% endfor %}
{% if schema.addableProperties %}
    protected $additionalProperties;
{% endif %}

    public function __construct(
{% for param in schema.constructParam %}
        {{ param }}
{% endfor %}
    ) {
{% for type in schema.typeList %}
        $this->{{ type.name }} = ${{ type.name }};
{% endfor %}
{% if schema.addableProperties %}
        $this->additionalProperties = $additionalProperties;
{% endif %}
    }
{% for type in schema.typeList %}

    public function {{ type.name }}(): {{ type.hint }}
    {
        return $this->{{ type.name }};
    }
{% endfor %}
{% if schema.addableProperties %}

    public function additionalProperties(): array
    {
        return $this->additionalProperties;
    }
{% endif %}
}
