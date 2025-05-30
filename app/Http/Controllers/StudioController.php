<?php

namespace App\Http\Controllers;

use App\Interfaces\ScheduleRepositoryInterface;
use App\Interfaces\StudioRepositoryInterface;

class StudioController extends Controller
{
    private StudioRepositoryInterface $studioRepository;
    private ScheduleRepositoryInterface $scheduleRepository;

    public function __construct(
        StudioRepositoryInterface $studioRepository,
        ScheduleRepositoryInterface $scheduleRepository
    ) {
        $this->studioRepository = $studioRepository;
        $this->scheduleRepository = $scheduleRepository;
    }

    public function index()
    {
        $studios = $this->studioRepository->getAllStudios();

        return view('pages.studios.index', compact('studios'));
    }

    public function show($id)
    {
        $studio = $this->studioRepository->getStudioById($id);
        $schedules = $this->scheduleRepository->getScheduleByStudio($id);
        $seats = $this->studioRepository->createStudioSeats($id);

        return view('pages.studios.show', compact('studio', 'schedules', 'seats'));
    }
}
