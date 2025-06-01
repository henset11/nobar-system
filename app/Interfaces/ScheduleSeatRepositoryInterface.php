<?php

namespace App\Interfaces;

interface ScheduleSeatRepositoryInterface
{
    public function getSeatBySchedule($schedule = null);

    public function setSeatBooked($id);
}
