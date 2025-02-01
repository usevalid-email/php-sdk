<?php

namespace UseValidEmail\Sdk\Enums;

class Enum
{
    public static function toArray(): array
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    public static function isValid($value): bool
    {
        return in_array($value, static::toArray(), true);
    }

    public static function assertValid($value): void
    {
        if (! static::isValid($value)) {
            throw new \InvalidArgumentException('Invalid value for '.static::class.": $value");
        }
    }

    public static function assertValidOrNull($value): void
    {
        if ($value !== null) {
            static::assertValid($value);
        }
    }

    public static function assertValidOrEmpty($value): void
    {
        if ($value !== '') {
            static::assertValid($value);
        }
    }

    public static function assertValidOrEmptyOrNull($value): void
    {
        if ($value !== null && $value !== '') {
            static::assertValid($value);
        }
    }
}
