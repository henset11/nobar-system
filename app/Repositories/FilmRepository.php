<?php

namespace App\Repositories;

use App\Interfaces\FilmRepositoryInterface;
use App\Models\Film;
use Illuminate\Database\Eloquent\Builder;

class FilmRepository implements FilmRepositoryInterface
{
    public function getAllFilms($search = null, $genre = null)
    {
        $query = Film::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('release_year', 'like', "%{$search}%");
        }

        if ($genre) {
            $query->whereHas('genres', function (Builder $query) use ($genre) {
                $query->where('id', $genre);
            });
        }

        return $query->get();
    }

    public function getFilmBySchedule($schedule = null)
    {
        return Film::whereHas('schedules', function (Builder $query) use ($schedule) {
            $query->where('id', $schedule);
        })->get();
    }

    public function getFilmById($id = null)
    {
        return Film::where('id', $id)->first();
    }

    public function getFilmNowPlaying()
    {
        return Film::whereHas('schedules', function (Builder $query) {
            $query->where('play_date', '>=', now()->format('Y-m-d'))
                ->orderBy('play_date', 'asc');
        })->get();
    }
}
