<?php

namespace App\Repositories;

use App\Interfaces\ScheduleSeatRepositoryInterface;
use App\Models\ScheduleSeat;
use Illuminate\Database\Eloquent\Builder;

class ScheduleSeatRepository implements ScheduleSeatRepositoryInterface
{
    public function getSeatBySchedule($schedule = null)
    {
        $seats = ScheduleSeat::whereHas('schedule', function (Builder $query) use ($schedule) {
            $query->where('id', $schedule);
        })->get();

        return $seats->groupBy(function ($item) {
            return substr($item->seat_number, 0, 1);
        });
    }

    public function setSeatBooked($id)
    {
        $seat = ScheduleSeat::find($id);
        $seat->is_booked = true;

        return $seat->save();
    }
}
