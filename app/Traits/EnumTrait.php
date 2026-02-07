<?php

namespace App\Traits;

trait EnumTrait
{
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
