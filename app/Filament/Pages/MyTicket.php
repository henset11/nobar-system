<?php

namespace App\Filament\Pages;

use App\Models\Ticket;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Concerns\InteractsWithTable;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Hugomyb\FilamentMediaAction\Tables\Actions\MediaAction;

class MyTicket extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static string $view = 'filament.pages.my-ticket';

    protected static ?string $title = 'My Ticket';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Ticket::query()->where('student_id', auth()->id())
            )
            ->columns([
                Split::make([
                    TextColumn::make('code')
                        ->formatStateUsing(fn($record) => "Booking Code:<br><b>{$record->code}</b>")
                        ->html()
                        ->searchable()
                        ->sortable(),
                    SpatieMediaLibraryImageColumn::make('schedule.film.media')
                        ->collection('film')
                        ->size(100)
                        ->grow(false)
                        ->action(
                            MediaAction::make('trailer')
                                ->media(fn($record) => $record->schedule->film->trailer)
                                ->autoplay()
                                ->preload(false)
                        ),
                    Grid::make([
                        'md' => 2,
                        'lg' => 1
                    ])->schema([
                        TextColumn::make('schedule.film.name')
                            ->weight(FontWeight::Bold)
                            ->label('Film')
                            ->searchable()
                            ->sortable()
                            ->wrap()
                            ->formatStateUsing(function ($record) {
                                return "{$record->schedule->film->name} ({$record->schedule->film->release_year})";
                            }),
                        TextColumn::make('schedule.film.duration')
                            ->numeric()
                            ->icon('heroicon-o-clock')
                            ->suffix(' menit'),
                    ]),
                    TextColumn::make('seat.seat_number')
                        ->label('Seat')
                        ->badge(),
                    Stack::make([
                        TextColumn::make('schedule.play_date')
                            ->date('j F Y', 'Asia/Jakarta')
                            ->sortable()
                            ->icon('heroicon-o-calendar-days')
                            ->label('Schedule'),
                        TextColumn::make('schedule.play_time')
                            ->label('Play Time')
                            ->icon('heroicon-o-clock')
                            ->date('H:i'),
                    ]),
                    TextColumn::make('status')
                        ->badge()
                        ->color(fn($state) => match ($state) {
                            'pending' => 'warning',
                            'success' => 'success',
                            'failed' => 'failed',
                        })
                ])->from('md')
            ]);
    }
}
