<?php

namespace App\Repositories;

use App\Interfaces\ScheduleRepositoryInterface;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Builder;

class ScheduleRepository implements ScheduleRepositoryInterface
{
    public function getAllSchedules()
    {
        return Schedule::where('play_date', '>=', now())
            ->orderBy('play_date', 'asc')
            ->get();
    }

    public function getScheduleByFilm($film = null)
    {
        return Schedule::whereHas('film', function (Builder $query) use ($film) {
            $query->where('id', $film);
        })->get();
    }
}
