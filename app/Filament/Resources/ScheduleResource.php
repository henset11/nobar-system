<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Film;
use Filament\Tables;
use App\Models\Studio;
use App\Models\Schedule;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Filters\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Coolsam\Flatpickr\Forms\Components\Flatpickr;
use RalphJSmit\Filament\Components\Forms\Sidebar;
use App\Filament\Resources\ScheduleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use RalphJSmit\Filament\Components\Forms\Timestamps;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Schedule Management';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return 'Schedule';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Sidebar::make([
                    Section::make()
                        ->columns(2)
                        ->description(fn($context) => $context === 'create' ? 'Add new schedule for movies' : 'Edit schedule for movies')
                        ->schema([
                            Forms\Components\Select::make('film_id')
                                ->relationship('film', 'name')
                                ->placeholder('Select a film')
                                ->getOptionLabelFromRecordUsing(fn(Film $record) => "{$record->name} ({$record->release_year})")
                                ->searchable(['name', 'release_year'])
                                ->preload()
                                ->required(),
                            Forms\Components\Select::make('studio_id')
                                ->relationship('studio', 'name')
                                ->placeholder('Select studio')
                                ->getOptionLabelFromRecordUsing(fn(Studio $record) => "{$record->name} ({$record->capacity})")
                                ->searchable(['name', 'capacity'])
                                ->preload()
                                ->required(),
                            Flatpickr::make('play_date')
                                ->altFormat('j F Y')
                                ->disableMobile(true)
                                ->locale('id')
                                ->minDate(fn() => today())
                                ->prefixIcon('heroicon-o-calendar-days'),
                            Flatpickr::make('play_time')
                                ->timePicker()
                                ->seconds(false)
                                ->format('H:i')
                                ->altFormat('H:i')
                                ->disableMobile(true)
                                ->time24hr(true)
                                ->prefixIcon('heroicon-o-clock')
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
                Tables\Columns\TextColumn::make('film.name')
                    ->formatStateUsing(function ($state, $record) {
                        return "{$record->film->name} ({$record->film->release_year})";
                    })
                    ->searchable(['name', 'release_year'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('studio.name')
                    ->formatStateUsing(function ($state, $record) {
                        return "{$record->studio->name} ({$record->studio->capacity})";
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('play_date')
                    ->date('j F Y', 'Asia/Jakarta')
                    ->sortable(),
                Tables\Columns\TextColumn::make('play_time')
                    ->date('H:i'),
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        DateConstraint::make('play_date')
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
