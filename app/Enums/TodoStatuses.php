<?php

namespace App\Enums;

enum TodoStatuses: string
{
    case TODO = 'todo';
    case PENDING = 'pending';
    case FAILED = 'failed';
    case DONE = 'done';

    public static function values()
    {
        $values = [];

        foreach (self::cases() as $case){
            $values[$case->name] = $case->value;
        }

        return $values;
    }

    public static function selectValues()
    {
        $values = [];

        foreach (self::cases() as $case){
            $values[$case->value] = ucfirst($case->value);
        }

        return $values;
    }

    public static function nextStep($status)
    {
        return match ($status){
            self::TODO => [
                self::PENDING,
                self::FAILED
            ],
            self::PENDING => [
                self::FAILED,
                self::DONE
            ],
            self::FAILED => [
                self::TODO
            ],
            self::DONE => [],
        };
    }
}