<?php

namespace App\Http\Controllers;

use App\Interfaces\FilmRepositoryInterface;
use App\Interfaces\GenreRepositoryInterface;
use App\Interfaces\StudioRepositoryInterface;

class HomeController extends Controller
{
    private GenreRepositoryInterface $genreRepository;
    private FilmRepositoryInterface $filmRepository;
    private StudioRepositoryInterface $studioRepository;

    public function __construct(
        GenreRepositoryInterface $genreRepository,
        FilmRepositoryInterface $filmRepository,
        StudioRepositoryInterface $studioRepository
    ) {
        $this->genreRepository = $genreRepository;
        $this->filmRepository = $filmRepository;
        $this->studioRepository = $studioRepository;
    }

    public function index()
    {
        $genres = $this->genreRepository->getPopularGenres();
        $films = $this->filmRepository->getAllFilms();
        $filmPlaying = $this->filmRepository->getFilmNowPlaying();
        $studios = $this->studioRepository->getAllStudios();

        return view('pages.home', compact('genres', 'films', 'filmPlaying', 'studios'));
    }
}
