<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Studio extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'capacity',
        'seat_rows',
    ];

    protected $casts = [
        'seat_rows' => 'array'
    ];

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function generateSeatData(int $scheduleId): array
    {
        $capacity = $this->capacity;
        $rows = $this->seat_rows ?? ['A', 'B', 'C'];
        $totalRows = count($rows);

        $baseSeats = intdiv($capacity, $totalRows);
        $remaining = $capacity % $totalRows;

        $seatData = [];

        foreach ($rows as $index => $row) {
            $seatsInRow = $baseSeats + ($index < $remaining ? 1 : 0);

            for ($i = 1; $i <= $seatsInRow; $i++) {
                $seatData[] = [
                    'schedule_id' => $scheduleId,
                    'seat_number' => $row . $i,
                    'is_booked' => false,
                ];
            }
        }

        return $seatData;
    }
}
