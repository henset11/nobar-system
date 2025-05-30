<?php

namespace App\Interfaces;

interface ScheduleRepositoryInterface
{
    public function getAllSchedules();

    public function getScheduleByFilm($film = null, $date = null);

    public function getScheduleById($id);

    public function getScheduleByStudio($studio = null);

    public function getScheduleForTicket($id);
}
