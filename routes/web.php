<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

// Home Page
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

// Forgot Password Page
Route::middleware('passwordreset.enabled')->group(function () {
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
});

// Validate Password
Route::post('/validate-password', [ProfileController::class, 'validatePassword'])->name('validate.password');

Route::middleware(['auth', 'verified'])->group(function () {
    // Ticket Page
    Route::get('/ticket', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/ticket/order/{scheduleId}', [TicketController::class, 'order'])->name('ticket.order');
    Route::post('/ticket/order', [TicketController::class, 'createTicket'])->name('ticket.create');
    Route::get('/ticket/confirmation', [TicketController::class, 'confirmation'])->name('ticket.confirmation');
    Route::get('/ticket/details/{id}', [TicketController::class, 'detailTicket'])->name('ticket.details');

    // Profile Page
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/security', [ProfileController::class, 'security'])->name('profile.security');
    Route::get('/profile/security/change-password', [ProfileController::class, 'changePassword'])->name('profile.change.password');
    Route::get('/profile/security/delete-account', [ProfileController::class, 'deleteAccount'])->name('profile.delete.account');
    Route::post('/profile/security/delete-account', [ProfileController::class, 'confirmDelete'])->name('profile.delete.confirm');
    Route::get('/profile/theme', [ProfileController::class, 'theme'])->name('profile.theme');
    Route::get('/profile/help', [ProfileController::class, 'help'])->name('profile.help');
});

// Confirmation Ticket
Route::middleware(['auth', 'verified', 'can:page_Ticket'])->group(function () {
    Route::get('/ticket/check', [TicketController::class, 'checkTicket'])->name('ticket.check');
    Route::post('/ticket/validate', [TicketController::class, 'confirmTicket'])->name('ticket.validate');
});

// OAuth Login
Route::get('/oauth/google', [SocialiteController::class, 'googleRedirect'])->name('auth.google');
Route::get('/oauth/google/callback', [SocialiteController::class, 'googleCallBack']);
