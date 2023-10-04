<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)
                    ->schema([
                        Wizard::make([
                            Wizard\Step::make('User Information')
                                ->description('Enter basic user information')
                                ->schema([
                                    Grid::make(2)
                                        ->schema([
                                            Forms\Components\TextInput::make('name')
                                                ->required()
                                                ->maxLength(255),
                                            Forms\Components\TextInput::make('email')
                                                ->email()
                                                ->required()
                                                ->unique(ignoreRecord: true)
                                                ->maxLength(255),
                                        ]),
                                    Grid::make(2)
                                        ->schema([
                                            Forms\Components\TextInput::make('password')
                                                ->password()
                                                ->required()
                                                ->maxLength(255)
                                                ->hiddenOn('edit')
                                                ->visibleOn('create')
                                                ->confirmed(),
                                            Forms\Components\TextInput::make('password_confirmation')
                                                ->password()
                                                ->maxLength(255)
                                                ->hiddenOn('edit')
                                                ->required()
                                                ->visibleOn('create'),
                                        ]),
                                    Grid::make(2)
                                        ->schema([
                                            Forms\Components\RichEditor::make('two_factor_secret')
                                                ->maxLength(65535)
                                                ->columnSpanFull(),
                                            Forms\Components\RichEditor::make('two_factor_recovery_codes')
                                                ->maxLength(65535)
                                                ->columnSpanFull(),
                                        ]),
                                    Grid::make(2)
                                        ->schema([
                                            Forms\Components\DateTimePicker::make('two_factor_confirmed_at'),
                                            Forms\Components\TextInput::make('current_team_id')
                                                ->numeric(),
                                        ])
                                ]),
                            Wizard\Step::make('Bio & Social Media')
                                ->description('User\'s Bio and Social media pages')
                                ->columnSpanFull()
                                ->schema([
                                    Forms\Components\RichEditor::make('bio')
                                        ->columnSpanFull(),
                                    Repeater::make('social')
                                        ->columnSpanFull()
                                        ->relationship()
                                        ->schema([
                                            Forms\Components\TextInput::make('facebook')
                                                ->columnSpanFull()
                                                ->prefix('https://facebook.com/')
                                                ->placeholder("Enter your facebook username"),
                                            Forms\Components\TextInput::make('instagram')
                                                ->columnSpanFull()
                                                ->prefix('https://instagram.com/')
                                                ->placeholder("Enter your instagram username"),
                                            Forms\Components\TextInput::make('linkedin')
                                                ->columnSpanFull()
                                                ->prefix('https://linkedin.com/in/')
                                                ->placeholder("Enter your linkedin username"),
                                            Forms\Components\TextInput::make('threads')
                                                ->columnSpanFull()
                                                ->prefix('https://threads.com/')
                                                ->placeholder("Enter your threads username"),
                                            Forms\Components\TextInput::make('x')
                                                ->columnSpanFull()
                                                ->prefix('https://x.com/')
                                                ->placeholder("Enter your x username"),
                                        ])
                                ]),
                            Wizard\Step::make('User Roles')
                                ->description('User\'s roles and permissions')
                                ->columnSpanFull()
                                ->schema([
                                    Forms\Components\Select::make('roles')
                                        ->multiple()
                                        ->relationship('roles', 'name')
                                        ->preload()
                                ])
                        ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('two_factor_confirmed_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('current_team_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('profile_photo_path')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable(),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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
