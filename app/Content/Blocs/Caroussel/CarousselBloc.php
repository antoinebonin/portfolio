<?php

declare(strict_types=1);

namespace App\Content\Blocs\Caroussel;

use App\Content\BaseBloc;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;

class CarousselBloc extends BaseBloc
{
    public function getTitle(): string
    {
        return 'Caroussel';
    }

    public function getBlock(): Block
    {
        return Block::make($this->getTitle())
            ->schema([
                Components\Repeater::make('items')
                    ->minItems(1)
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Components\TextInput::make('name')
                            ->live(onBlur: true)
                            ->required(),
                        Components\TextInput::make('url')
                            ->activeUrl(),
                        FileUpload::make('image')
                            ->image()
                            ->required(),

                    ])
                    ->grid(2)
                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
            ])
            ->preview($this->getPreview());
    }

    public function getPreview(): string
    {
        return $this->getCustomBladeNamespace() . 'Caroussel/caroussel';
    }

    public function getComponentClassName(): string
    {
        return CarousselComponent::class;
    }

    public function getComponentAlias(): string
    {
        return implode('-', [$this->getCustomComponentNamespace(), Str::lower($this->getTitle())]);
    }
}
