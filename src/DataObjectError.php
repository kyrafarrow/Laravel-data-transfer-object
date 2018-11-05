<?php

namespace Spatie\DataObject;

use TypeError;

class DataObjectError extends TypeError
{
    public static function unknownProperties(array $properties, string $className): DataObjectError
    {
        $propertyNames = implode('`, `', $properties);

        return new self("Public properties `{$propertyNames}` not found on {$className}");
    }

    public static function invalidType(Property $property, $value): DataObjectError
    {
        if ($value === null) {
            $value = 'null';
        }

        if (is_object($value)) {
            $value = get_class($value);
        }

        if (is_array($value)) {
            $value = 'array';
        }

        $expectedTypes = implode(', ', $property->getTypes());

        return new self("Invalid type: expected {$property->getFqn()} to be of type {$expectedTypes}, instead got value `{$value}`.");
    }

    public static function uninitialized(Property $property): DataObjectError
    {
        return new self("Non-nullable property {$property->getFqn()} has not been initialized.");
    }
}
