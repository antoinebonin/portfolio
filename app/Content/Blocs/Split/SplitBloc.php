<?php

declare(strict_types=1);

namespace App\Content\Blocs\Split;

use App\Content\BaseBloc;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components;
use Illuminate\Support\Str;

class SplitBloc extends BaseBloc
{
    public function getTitle(): string
    {
        return 'Split';
    }

    public function getBlock(): Block
    {
        return Block::make($this->getTitle())
            ->schema([
                Components\TextInput::make('title')->required(),
                Components\Checkbox::make('inverse'),
                Components\Textarea::make('content')->required()
                    ->autosize()
            ])
            ->preview($this->getPreview());
    }

    public function getPreview(): string
    {
        return $this->getCustomBladeNamespace() . 'Split/split';
    }

    public function getComponentClassName(): string
    {
        return SplitComponent::class;
    }

    public function getComponentAlias(): string
    {
        return implode('-', [$this->getCustomComponentNamespace(), Str::lower($this->getTitle())]);
    }
}
