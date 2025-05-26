<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Film;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use App\Filament\Resources\FilmResource\Pages;
use RalphJSmit\Filament\Components\Forms\Sidebar;
use RalphJSmit\Filament\Components\Forms\Timestamps;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Hugomyb\FilamentMediaAction\Tables\Actions\MediaAction;

class FilmResource extends Resource
{
    protected static ?string $model = Film::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Movie Management';

    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return 'Film';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Sidebar::make(
                    [
                        Section::make('Film')
                            ->columns(2)
                            ->description(fn($context) => $context === 'create' ? 'Add new film to play' : 'Edit film to play')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->columnSpanFull()
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('duration')
                                    ->numeric()
                                    ->suffix('menit')
                                    ->minValue(0)
                                    ->default(0),
                                Forms\Components\TextInput::make('release_year')
                                    ->numeric()
                                    ->minValue(1000)
                                    ->default(now()->year)
                                    ->required(),
                                Forms\Components\Select::make('genres')
                                    ->columnSpanFull()
                                    ->required()
                                    ->multiple()
                                    ->searchable()
                                    ->optionsLimit(10)
                                    ->preload()
                                    ->relationship('genres', 'name'),
                                Forms\Components\TextInput::make('trailer')
                                    ->columnSpanFull()
                                    ->prefix('https://www.youtube.com/watch?v=')
                                    ->required()
                                    ->maxLength(255),
                                SpatieMediaLibraryFileUpload::make('image')
                                    ->required()
                                    ->columnSpanFull()
                                    ->collection('film')
                                    ->resize(50)
                                    ->optimize('webp'),
                                Forms\Components\RichEditor::make('description')
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('producer')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('director')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('writers')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('production')
                                    ->maxLength(255),
                            ])
                    ],
                    [
                        Section::make()
                            ->schema([
                                ...Timestamps::make(),
                            ])
                    ]
                )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    SpatieMediaLibraryImageColumn::make('poster')
                        ->collection('film')
                        ->size(100)
                        ->grow(false)
                        ->action(
                            MediaAction::make('trailer')
                                ->media(fn($record) => $record->trailer)
                                ->autoplay()
                                ->preload(false),
                        ),
                    Grid::make([
                        'xs' => 2,
                        'lg' => 1
                    ])->grow(false)
                        ->schema([
                            Tables\Columns\TextColumn::make('name')
                                ->size(TextColumnSize::Large)
                                ->weight(FontWeight::Bold)
                                ->formatStateUsing(function ($record) {
                                    return "{$record->name} ({$record->release_year})";
                                })
                                ->wrap()
                                ->searchable(['name', 'release_year'])
                                ->sortable(),
                            Tables\Columns\TextColumn::make('duration')
                                ->numeric()
                                ->icon('heroicon-o-clock')
                                ->suffix(' menit'),
                        ]),
                    Tables\Columns\TextColumn::make('description')
                        ->html()
                        ->limit(100)
                        ->wrap(),
                    Tables\Columns\TextColumn::make('genres.name')
                        ->badge()
                        ->listWithLineBreaks()
                        ->limitList(2)
                        ->expandableLimitedList()
                        ->color('success')
                        ->searchable()
                        ->toggleable()
                        ->grow(false),
                    Stack::make([
                        Tables\Columns\TextColumn::make('producer')
                            ->searchable()
                            ->icon('heroicon-o-users'),
                        Tables\Columns\TextColumn::make('writers')
                            ->icon('heroicon-o-user-group'),
                        Tables\Columns\TextColumn::make('production')
                            ->searchable()
                            ->icon('heroicon-o-building-office')
                            ->sortable(),
                    ])
                ])->from('md')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListFilms::route('/'),
            'create' => Pages\CreateFilm::route('/create'),
            'edit' => Pages\EditFilm::route('/{record}/edit'),
        ];
    }
}
