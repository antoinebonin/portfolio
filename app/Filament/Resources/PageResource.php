<?php

namespace App\Filament\Resources;

use App\Content\BlocService;
use App\Enum\PageStatutEnum;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static ?string $navigationGroup = 'Navigation';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Split::make([
                    Forms\Components\Section::make([
                        Forms\Components\Builder::make('blocs')
                            ->blocks(
                                BlocService::getAllBlocks()
                            )
                            ->required()
                            ->collapsible()
                            ->collapsed()
                            ->blockIcons()
                            ->cloneable()
                            ->blockNumbers(false)
                    ]),
                    Forms\Components\Section::make([
                        Forms\Components\TextInput::make('title')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('url', Str::slug($state)))
                            ->required(),
                        Forms\Components\TextInput::make('url')
                            ->prefix(config('app.url') . '/')
                            ->unique(ignoreRecord: true)
                            ->disabled(function (?Page $page) {
                                return $page->id === 1;
                            }),
                        Forms\Components\Select::make('statut')
                            ->options(PageStatutEnum::toArray())
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->autosize()
                            ->required(),
                    ])->grow(false)
                ])->from('md')->columnSpan('full')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('url')
                    ->prefix(config('app.url') . '/'),
                Tables\Columns\IconColumn::make('statut')
                    ->icon(fn (PageStatutEnum $state): string => $state->getIcon())
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('Show')
                        ->icon('heroicon-o-eye')
                        ->url(fn (Page $record): string => $record->getFullUrl())
                        ->openUrlInNewTab(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ReplicateAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
