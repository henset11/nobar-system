<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Table;
use App\Models\Ticket as ModelsTicket;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Concerns\InteractsWithTable;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class Ticket extends Page implements HasTable
{
    use HasPageShield, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static string $view = 'filament.pages.ticket';

    public function table(Table $table): Table
    {
        return $table
            ->query(ModelsTicket::query())
            ->columns([
                Split::make([
                    Stack::make([
                        SpatieMediaLibraryImageColumn::make('schedule.film.media')
                            ->collection('film')
                            ->size(100)
                            ->grow(false),
                        TextColumn::make('code')
                            ->searchable()
                            ->sortable(),
                    ]),
                    Stack::make([
                        TextColumn::make('student.name')
                            ->searchable()
                            ->sortable(),
                        TextColumn::make('seat.seat_number')
                            ->label('Seat')
                            ->badge(),
                    ]),
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
                    TextColumn::make('booking_date')
                        ->date('d/m/Y H:i')
                        ->formatStateUsing(function ($record, $state) {
                            return "Booking Date:<br>{$state}";
                        })
                        ->html()
                        ->sortable(),
                    SelectColumn::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'success' => 'Success',
                            'failed' => 'Failed',
                        ])
                        ->rules(['required'])
                        ->selectablePlaceholder(false)
                ])->from('md')
            ])
            ->actions([
                DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
