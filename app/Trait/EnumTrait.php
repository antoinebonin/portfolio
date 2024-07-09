<?php

declare(strict_types=1);

namespace App\Trait;

trait EnumTrait
{
    /**
     * @return string[]
     */
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * @return string[]
     */
    public static function getNames(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function toArray(): array
    {
        return array_combine(self::getValues(), self::getNames());
    }
}
