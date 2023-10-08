<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurSocialResource\Pages;
use App\Filament\Resources\OurSocialResource\RelationManagers;
use App\Models\OurSocial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OurSocialResource extends Resource
{
    protected static ?string $model = OurSocial::class;

    protected static ?string $navigationIcon = 'heroicon-o-finger-print';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('platform')
                    ->required()
                    ->options([
                        'X' => 'X',
                        'Telegram' => 'Telegram',
                        'Facebook' => 'Facebook',
                        'Instagram' => 'Instagram',
                        'LinkedIn' => 'LinkedIn'
                    ]),
                Forms\Components\TextInput::make('link')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('platform')
                    ->searchable(),
                Tables\Columns\TextColumn::make('link')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageOurSocials::route('/'),
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
