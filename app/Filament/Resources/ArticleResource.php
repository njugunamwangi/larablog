<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Filament\Resources\ArticleResource\Widgets\ArticleStats;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-at-symbol';

    protected static ?string $navigationGroup = 'Article Management';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(2048),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->hiddenOn('create')
                            ->columnSpanFull()
                            ->maxLength(2048),
                        Forms\Components\RichEditor::make('body')
                            ->required()
                            ->columnSpanFull(),
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('meta_description')
                                    ->maxLength(255),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Forms\Components\DateTimePicker::make('scheduled_for'),
                            ])
                    ])->columnSpan(8),
                Section::make()
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('articles')
                            ->label('Featured Image')
                            ->directory('articles')
                            ->collection('articles')
                            ->imageEditor()
                            ->required()
                            ->preserveFilenames(),
                        Forms\Components\Select::make('category_id')
                            ->relationship('categories', 'category')
                            ->required()
                            ->preload()
                            ->multiple()
                            ->searchable(),
                        Forms\Components\Select::make('location_id')
                            ->relationship('locations', 'location')
                            ->required()
                            ->preload()
                            ->multiple()
                            ->searchable(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'reviewing' => 'Reviewing',
                                'published' => 'Published',
                            ])
                            ->searchable()
                            ->required()
                            ->default('draft'),
                        Forms\Components\Select::make('author_id')
                            ->relationship('author', 'name')
                            ->options(User::role(Role::where('name', 'author')
                                ->first())
                                ->get()
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('editor_id')
                            ->relationship('editor', 'name')
                            ->options(User::role(Role::where('name', 'editor')
                                ->first())
                                ->get()
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])->columnSpan(4),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultGroup('status')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(['title', 'body']),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'reviewing' => 'warning',
                        'published' => 'success',
                    }),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('scheduled_for')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('author.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('editor.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('meta_title')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('meta_description')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'reviewing' => 'Reviewing',
                        'published' => 'Published',
                    ]),
                SelectFilter::make('author')
                    ->options(User::role(Role::where('name', 'author')->first())->get()->pluck('name', 'id'))
                    ->preload()
                    ->searchable(),
                SelectFilter::make('editor')
                    ->options(User::role(Role::where('name', 'editor')->first())->get()->pluck('name', 'id'))
                    ->preload()
                    ->searchable(),
                SelectFilter::make('category')
                    ->label('Category')
                    ->relationship('categories', 'category')
                    ->options(Category::all()->pluck('name', 'id'))
                    ->searchable()
                    ->preload()
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
                            Components\Grid::make(2)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('title'),
                                        Components\TextEntry::make('slug'),
                                        Components\TextEntry::make('published_at')
                                            ->date(),
                                        Components\TextEntry::make('status')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'draft' => 'gray',
                                                'reviewing' => 'warning',
                                                'published' => 'success',
                                            }),
                                    ]),
                                    Components\Group::make([
                                        Components\TextEntry::make('author.name'),
                                        Components\TextEntry::make('editor.name'),
                                        Components\TextEntry::make('categories.category'),
                                        Components\TextEntry::make('locations.location'),
                                    ]),
                                ]),
                            SpatieMediaLibraryImageEntry::make('articles')
                                ->collection('articles')
                                ->label('Featured Image')
                                ->grow(false),
                        ])->from('lg'),
                    ]),
                Components\Section::make('Body')
                    ->schema([
                        Components\TextEntry::make('body')
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
            RelationManagers\CommentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug', 'author.name', 'editor.name', 'body', 'locations.location', 'categories.category'];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['author', 'editor', 'categories', 'locations']);
    }

    public static function getWidgets(): array
    {
        return [
            ArticleStats::class
        ];
    }
}
