<?php

namespace {{ schema.schemaInfo.namespace }};

use Eloquent\Enumeration\AbstractEnumeration;

class {{ schema.schemaInfo.name }} extends AbstractEnumeration
{
{% for key, value in schema.values %}
    public const {{key}} = {{value|raw}};
{% endfor %}
}
