<?php

declare(strict_types=1);

namespace App\Content;

use Filament\Forms\Components\Builder\Block;
use Illuminate\View\Component;

interface Bloc
{
    public function getTitle(): string;
    public function getBlock(): Block;
    public function getPreview(): string;
    public function getComponentClassName(): string;
    public function getComponentAlias(): string;
}
