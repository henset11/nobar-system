<?php

namespace App\Repositories;

use App\Interfaces\GenreRepositoryInterface;
use App\Models\Genre;

class GenreRepository implements GenreRepositoryInterface
{
    public function getAllGenres()
    {
        return Genre::all();
    }

    public function getPopularGenres($limit = 6)
    {
        return Genre::where('is_popular', 1)
            ->orderBy('name', 'desc')
            ->take($limit)
            ->get();
    }
}
