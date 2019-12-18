<?php

namespace Spatie\DataTransferObject;

use Closure;

class FieldCache
{
    /** @var array */
    private static $cache = [];

    public static function resolve(string $class, string $field, Closure $closure): FieldValidator
    {
        if (! isset(self::$cache[$class][$field])) {
            self::$cache[$class][$field] = $closure();
        }

        return self::$cache[$class][$field];
    }
}
