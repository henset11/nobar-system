<?php

namespace App\Http\Controllers;

use App\Interfaces\FilmRepositoryInterface;
use App\Interfaces\GenreRepositoryInterface;

class GenreController extends Controller
{
    private GenreRepositoryInterface $genreRepository;
    private FilmRepositoryInterface $filmRepository;

    public function __construct(
        GenreRepositoryInterface $genreRepository,
        FilmRepositoryInterface $filmRepository
    ) {
        $this->genreRepository = $genreRepository;
        $this->filmRepository = $filmRepository;
    }

    public function index()
    {
        $populars = $this->genreRepository->getPopularGenres();
        $genres = $this->genreRepository->getAllGenres();

        return view('pages.genres.index', compact('populars', 'genres'));
    }

    public function filmByGenre($id)
    {
        $genre = $this->genreRepository->getGenreById($id);
        $films = $this->filmRepository->getAllFilms(null, $id);

        return view('pages.genres.films', compact('genre', 'films'));
    }
}
