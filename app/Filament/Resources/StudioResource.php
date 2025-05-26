<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Studio;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\StudioResource\Pages;
use RalphJSmit\Filament\Components\Forms\Sidebar;
use RalphJSmit\Filament\Components\Forms\Timestamps;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Hugomyb\FilamentMediaAction\Tables\Actions\MediaAction;

class StudioResource extends Resource
{
    protected static ?string $model = Studio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Movie Management';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return 'Studio';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Sidebar::make([
                    Section::make('Studio')
                        ->description(fn($context) => $context === 'create' ? 'Add new studio for play movies' : 'Edit studio for play movies')
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('image')
                                ->required()
                                ->collection('studio')
                                ->maxSize(2048)
                                ->maxWidth(1000)
                                ->optimize('webp'),
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('capacity')
                                ->required()
                                ->numeric()
                                ->minValue(0),
                            Forms\Components\Repeater::make('seat_rows')
                                ->label('Seat Rows')
                                ->simple(
                                    Forms\Components\TextInput::make('row')
                                        ->label('Row Name')
                                        ->required()
                                        ->maxLength(1),
                                )
                                ->columns(1)
                                ->addActionLabel('Add Row')
                                ->reorderable(false)
                                ->defaultItems(1),
                        ])
                ], [
                    Section::make()
                        ->schema([
                            ...Timestamps::make()
                        ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('studio')
                    ->size(50)
                    ->action(
                        MediaAction::make('image')
                            ->media(fn($record) => $record->getFirstMediaUrl('studio'))
                    ),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->numeric()
                    ->badge()
                    ->color('success')
                    ->tooltip('Max Capacity for Studio')
                    ->suffix(' person')
                    ->icon('heroicon-o-user'),
                Tables\Columns\TextColumn::make('seat_rows')
                    ->label('Seat Rows')
                    ->wrap()
                    ->badge()
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
            'index' => Pages\ListStudios::route('/'),
            'create' => Pages\CreateStudio::route('/create'),
            'edit' => Pages\EditStudio::route('/{record}/edit'),
        ];
    }
}
