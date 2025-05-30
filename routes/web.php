<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Category Page
Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/genres/{id}', [GenreController::class, 'filmByGenre'])->name('genres.film');

// Film Page
Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/{id}', [FilmController::class, 'show'])->name('films.show');

// Studio Page
Route::get('/studios', [StudioController::class, 'index'])->name('studios.index');
Route::get('/studios/{id}', [StudioController::class, 'show'])->name('studios.show');

// Ticket Page
Route::middleware(['auth'])->group(function () {
    Route::get('/ticket/order/{scheduleId}', [TicketController::class, 'order'])->name('ticket.order');
    Route::post('/ticket/order', [TicketController::class, 'createTicket'])->name('ticket.create');
    Route::get('/ticket/confirmation', [TicketController::class, 'confirmation'])->name('ticket.confirmation');
});
