<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\FilmRepositoryInterface;
use App\Interfaces\ScheduleRepositoryInterface;
use App\Services\FilmService;

class FilmController extends Controller
{
    private FilmRepositoryInterface $filmRepository;
    private ScheduleRepositoryInterface $scheduleRepository;
    private FilmService $filmService;

    public function __construct(
        FilmRepositoryInterface $filmRepository,
        ScheduleRepositoryInterface $scheduleRepository,
        FilmService $filmService
    ) {
        $this->filmRepository = $filmRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->filmService = $filmService;
    }

    public function index()
    {
        $films = $this->filmRepository->getAllFilms();
        $filmPlaying = $this->filmRepository->getFilmNowPlaying();

        return view('pages.films.index', compact('films', 'filmPlaying'));
    }

    public function show($id, Request $request)
    {
        $dateMovie = $this->filmService->getDateMovie($request['date']);

        $film = $this->filmRepository->getFilmById($id);
        $schedules = $this->scheduleRepository->getScheduleByFilm($id, $dateMovie)->groupBy('studio_id');
        $dates = $this->filmService->getNext7Dates();

        return view('pages.films.show', compact('film', 'schedules', 'dates', 'dateMovie'));
    }
}
