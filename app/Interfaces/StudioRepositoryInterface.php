<?php

namespace App\Interfaces;

interface StudioRepositoryInterface
{
    public function getAllStudios();

    public function getStudioById($id);

    public function createStudioSeats($id);
}
