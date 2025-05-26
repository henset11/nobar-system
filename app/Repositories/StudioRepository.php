<?php

namespace App\Repositories;

use App\Interfaces\StudioRepositoryInterface;
use App\Models\Studio;

class StudioRepository implements StudioRepositoryInterface
{
    public function getAllStudios()
    {
        return Studio::all();
    }
}
