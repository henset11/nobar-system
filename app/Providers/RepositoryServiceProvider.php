<?php

namespace App\Providers;

use App\Repositories\FilmRepository;
use App\Repositories\GenreRepository;
use App\Repositories\StudioRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ScheduleRepository;
use App\Interfaces\FilmRepositoryInterface;
use App\Interfaces\GenreRepositoryInterface;
use App\Interfaces\GoogleAuthRepositoryInterface;
use App\Repositories\ScheduleSeatRepository;
use App\Interfaces\StudioRepositoryInterface;
use App\Interfaces\ScheduleRepositoryInterface;
use App\Interfaces\ScheduleSeatRepositoryInterface;
use App\Interfaces\TicketRepositoryInterface;
use App\Repositories\GoogleAuthRepository;
use App\Repositories\TicketRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(GenreRepositoryInterface::class, GenreRepository::class);
        $this->app->bind(FilmRepositoryInterface::class, FilmRepository::class);
        $this->app->bind(StudioRepositoryInterface::class, StudioRepository::class);
        $this->app->bind(ScheduleRepositoryInterface::class, ScheduleRepository::class);
        $this->app->bind(ScheduleSeatRepositoryInterface::class, ScheduleSeatRepository::class);
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(GoogleAuthRepositoryInterface::class, GoogleAuthRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
