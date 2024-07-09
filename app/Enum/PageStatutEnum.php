<?php

declare(strict_types=1);

namespace App\Enum;

use App\Trait\EnumTrait;

enum PageStatutEnum: string
{
    use EnumTrait;

    case DRAFT = 'draft';
    case PUBLISH = 'publish';

    public function getIcon(): string
    {
        return match ($this) {
            self::DRAFT => 'heroicon-o-pencil',
            self::PUBLISH => 'heroicon-o-check-circle',
        };
    }
}
