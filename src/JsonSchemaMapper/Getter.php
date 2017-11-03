<?php

namespace JsonSchemaMapper;

use Eloquent\Enumeration\EnumerationInterface;

class Getter
{
    public static function array(array $value): array
    {
        $array = [];
        foreach ($value as $key => $v) {
            $array[$key] = self::value($v);
        }
        return $array;
    }

    public static function value($value)
    {
        if (is_array($value)) {
            return self::array($value);
        }
        if (is_scalar($value)) {
            return $value;
        }
        if ($value instanceof \DateTimeInterface) {
            return $value->format(DATE_RFC3339);
        }
        if ($value instanceof ExistsNull) {
            return null;
        }
        if ($value instanceof EnumerationInterface) {
            return $value->value();
        }
        return $value->toJsonArray();
    }
}
