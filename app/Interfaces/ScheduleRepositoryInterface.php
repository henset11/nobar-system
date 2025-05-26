<?php

namespace App\Interfaces;

interface ScheduleRepositoryInterface
{
    public function getAllSchedules();

    public function getScheduleByFilm($film = null);
}
