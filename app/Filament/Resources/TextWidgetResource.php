<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TextWidgetResource\Pages;
use App\Filament\Resources\TextWidgetResource\RelationManagers;
use App\Models\TextWidget;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TextWidgetResource extends Resource
{
    protected static ?string $model = TextWidget::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-vertical';
    protected static ?string $navigationGroup = 'Settings';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\SpatieMediaLibraryFileUpload::make('text-widgets')
                                    ->label('Featured Image')
                                    ->directory('text-widgets')
                                    ->collection('text-widgets')
                                    ->imageEditor()
                                    ->preserveFilenames(),
                            ])->columnSpan(6),
                        Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('key')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(2048),
                            ])->columnSpan(6),
                    ])->columns(12),

                Forms\Components\RichEditor::make('content')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('text-widgets')
                    ->label('Featured Image')
                    ->collection('text-widgets'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make()
                    ->schema([
                        Components\Split::make([
                            Components\Group::make([
                                Components\TextEntry::make('key'),
                                Components\TextEntry::make('title'),
                                Components\TextEntry::make('active')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        '0' => 'warning',
                                        '1' => 'success',
                                    })
                            ]),
                            SpatieMediaLibraryImageEntry::make('text-widgets')
                                ->collection('text-widgets')
                                ->label('Featured Image')
                                ->grow(false),
                        ])->from('lg'),
                    ]),
                Components\Section::make('Content')
                    ->schema([
                        Components\TextEntry::make('content')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ])
                    ->collapsed()
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
            'index' => Pages\ListTextWidgets::route('/'),
            'create' => Pages\CreateTextWidget::route('/create'),
            'view' => Pages\ViewTextWidget::route('/{record}'),
            'edit' => Pages\EditTextWidget::route('/{record}/edit'),
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
