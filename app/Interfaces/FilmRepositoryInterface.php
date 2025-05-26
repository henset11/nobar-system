<?php

namespace App\Interfaces;

interface FilmRepositoryInterface
{
    public function getAllFilms($search = null, $genre = null);

    public function getFilmBySchedule($schedule = null);

    public function getFilmById($id = null);

    public function getFilmNowPlaying();
}
