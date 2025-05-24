<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Film;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\FilmResource\Pages;
use RalphJSmit\Filament\Components\Forms\Sidebar;
use RalphJSmit\Filament\Components\Forms\Timestamps;

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
                                Forms\Components\Select::make('genres')
                                    ->required()
                                    ->multiple()
                                    ->preload()
                                    ->relationship('genres', 'name'),
                                Forms\Components\TextInput::make('trailer')
                                    ->columnSpanFull()
                                    ->prefix('https://www.youtube.com/watch?v=')
                                    ->required()
                                    ->maxLength(255),
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
                                ...Timestamps::make()
                            ])
                    ]
                )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('genre_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('trailer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('producer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('director')
                    ->searchable(),
                Tables\Columns\TextColumn::make('writers')
                    ->searchable(),
                Tables\Columns\TextColumn::make('production')
                    ->searchable(),
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
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListFilms::route('/'),
            'create' => Pages\CreateFilm::route('/create'),
            'edit' => Pages\EditFilm::route('/{record}/edit'),
        ];
    }
}
