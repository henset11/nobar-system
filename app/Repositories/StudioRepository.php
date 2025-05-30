<?php

namespace App\Repositories;

use App\Interfaces\StudioRepositoryInterface;
use App\Models\Studio;

class StudioRepository implements StudioRepositoryInterface
{
    public function getAllStudios()
    {
        return Studio::orderBy('name', 'asc')
            ->paginate(10);
    }

    public function getStudioById($id)
    {
        return Studio::findOrFail($id);
    }

    public function createStudioSeats($id)
    {
        $studio = Studio::findOrFail($id);
        $capacity = $studio->capacity;
        $rows = $studio->seat_rows ?? ['A', 'B', 'C'];
        $totalRows = count($rows);

        $baseSeats = intdiv($capacity, $totalRows);
        $remaining = $capacity % $totalRows;

        $seats = [];

        foreach ($rows as $index => $row) {
            $seatsInRow = $baseSeats + ($index < $remaining ? 1 : 0);

            for ($i = 1; $i <= $seatsInRow; $i++) {
                $seats[$row][] = $row . $i;
            }
        }

        return $seats;
    }
}
