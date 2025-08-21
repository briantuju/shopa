<?php

namespace App\Traits;

trait EnumToArray
{
    /* @return array<int, string> Get the names of the enum cases */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /* @return array<int, string> Get the values of the enum cases */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /* @return array<string, string> Get the names and values of the enum cases */
    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }
}
