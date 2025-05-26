<?php

namespace App\Repositories;

use App\Interfaces\ScheduleSeatRepositoryInterface;
use App\Models\ScheduleSeat;
use Illuminate\Database\Eloquent\Builder;

class ScheduleSeatRepository implements ScheduleSeatRepositoryInterface
{
    public function getSeatBySchedule($schedule = null)
    {
        return ScheduleSeat::whereHas('schedule', function (Builder $query) use ($schedule) {
            $query->where('id', $schedule);
        })->get();
    }
}
