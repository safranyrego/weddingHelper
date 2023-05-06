<?php

namespace App\Enums;

enum SupportedLocale: string
{
    case EN = 'en';
    case HU = 'hu';

    public static function values()
    {
        $values = [];

        foreach (self::cases() as $case){
            $values[$case->name] = $case->value;
        }

        return $values;
    }
}