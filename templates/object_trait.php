<?php

namespace {{ schema.schemaInfo.namespace }};

trait {{ schema.schemaInfo.name }}Trait
{
    use \JsonSchemaMapper\ObjectTrait;

    public function jsonProperties(): array
    {
        return [
{% for type in schema.typeList %}
            '{{ type.name }}',
{% endfor %}
        ];
    }

    public function addableJsonProperty(): bool
    {
        return {{ schema.addableProperties ? 'true' : 'false' }};
    }
}
