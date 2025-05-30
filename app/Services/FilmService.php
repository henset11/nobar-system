<?php

namespace App\Services;

use Carbon\Carbon;

class FilmService
{
    public function getDateMovie(?string $date): string
    {
        return $date ?? now()->format('Y-m-d');
    }

    public function getNext7Dates(): array
    {
        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $dates[] = Carbon::now()->addDays($i)->toDateString();
        }
        return $dates;
    }
}
