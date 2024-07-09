<?php

declare(strict_types=1);

namespace App\Content\Blocs\Hero;

use App\Content\BaseBloc;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;

class HeroBloc extends BaseBloc
{
    public function getTitle(): string
    {
        return 'Hero';
    }

    public function getBlock(): Block
    {
        return Block::make($this->getTitle())
            ->schema([
                Components\TextInput::make('title')->required(),
                Components\TextInput::make('subtitle'),
                Components\Textarea::make('intro')->autosize(),
                FileUpload::make('image')
                    ->image()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth('1080')
                    ->imageResizeTargetHeight('1080')


            ])
            ->preview($this->getPreview());
    }

    public function getPreview(): string
    {
        return $this->getCustomBladeNamespace() . 'Hero/hero';
    }

    public function getComponentClassName(): string
    {
        return HeroComponent::class;
    }

    public function getComponentAlias(): string
    {
        return implode('-', [$this->getCustomComponentNamespace(), Str::lower($this->getTitle())]);
    }
}
