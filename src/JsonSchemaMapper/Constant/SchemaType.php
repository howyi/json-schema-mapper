<?php

namespace JsonSchemaMapper\Constant;

use Eloquent\Enumeration\AbstractEnumeration;

class SchemaType extends AbstractEnumeration
{
    public const UNDEFINED = 0;
    public const STRING    = 1;
    public const DATETIME  = 2;
    public const INTEGER   = 3;
    public const NUMBER    = 4;
    public const ENUM      = 5;
    public const OBJECT    = 6;
    public const ARRAY     = 7;
    public const BOOLEAN   = 8;
    public const NULL      = 9;
    public const MIXED     = 10;

    private const CLASS_TYPES = [
        self::ENUM,
        self::OBJECT,
    ];

    public static function getKeySchemaTypeMap(): array
    {
        // Validation keywords
        return [
            self::ENUM => [
                'enum',
            ],
            self::NUMBER => [
                'multipleOf',
                'maximum',
                'exclusiveMaximum',
                'minimum',
                'exclusiveMinimum',
            ],
            self::STRING => [
                'maxLength',
                'minLength',
                'pattern',
            ],
            self::ARRAY => [
                'items',
                'additionalItems',
                'maxItems',
                'minItems',
                'uniqueItems',
                'contains',
                'allOf',
                'anyOf',
                'oneOf',
                'not',
            ],
            self::OBJECT => [
                'maxProperties',
                'minProperties',
                'required',
                'properties',
                'patternProperties',
                'additionalProperties',
                'dependencies',
                'propertyNames',
            ],
        ];
    }

    public function getPhpTypeMap(): array
    {
        return [
            self::NUMBER    => 'float',
            self::INTEGER   => 'int',
            self::STRING    => 'string',
            self::DATETIME  => '\DateTimeInterface',
            self::ARRAY     => 'array',
            self::BOOLEAN   => 'bool',
            self::NULL      => 'ExistenceNullInterface',
            self::MIXED     => 'mixed',
            self::UNDEFINED => 'mixed',
        ];
    }

    public function getPhpType(): string
    {
        return $this->getPhpTypeMap()[$this->value()];
    }

    public function isSingleType(): bool
    {
        return in_array($this->value(), array_keys($this->getPhpTypeMap()), true);
    }

    public function isClassType(): bool
    {
        return in_array($this->value(), self::CLASS_TYPES, true);
    }
}
