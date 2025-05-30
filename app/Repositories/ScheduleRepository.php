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
            ->paginate(10);
    }

    public function getScheduleByFilm($film = null, $date = null)
    {
        return Schedule::whereHas('film', function (Builder $query) use ($film, $date) {
            $query->where('id', $film)
                ->where('play_date', $date)
                ->orderBy('play_date', 'asc')
                ->orderBy('play_time', 'asc');
        })->get();
    }

    public function getScheduleById($id)
    {
        return Schedule::with(['film', 'studio', 'seats'])
            ->findOrFail($id);
    }

    public function getScheduleByStudio($studio = null)
    {
        return Schedule::whereHas('studio', function (Builder $query) use ($studio) {
            $query->where('id', $studio)
                ->where('play_date', '>=', now()->format('Y-m-d'))
                ->orderBy('play_date', 'asc')
                ->orderBy('play_time', 'asc');
        })->paginate(10);
    }
}
