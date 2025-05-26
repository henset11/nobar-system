<?php

namespace App\Interfaces;

interface GenreRepositoryInterface
{
    public function getAllGenres();

    public function getPopularGenres($limit = 6);
}
