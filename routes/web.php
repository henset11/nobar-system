<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

// Register Page
Route::middleware('registration.enabled')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');
});

Route::middleware('passwordreset.enabled')->group(function () {
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Ticket Page
    Route::get('/ticket', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/ticket/order/{scheduleId}', [TicketController::class, 'order'])->name('ticket.order');
    Route::post('/ticket/order', [TicketController::class, 'createTicket'])->name('ticket.create');
    Route::get('/ticket/confirmation', [TicketController::class, 'confirmation'])->name('ticket.confirmation');

    // Profile Page
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});

Route::middleware(['auth', 'verified', 'role:admin|super_admin'])->group(function () {
    Route::get('/ticket/check', [TicketController::class, 'checkTicket'])->name('ticket.check');
});
