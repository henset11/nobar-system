<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
use App\Interfaces\ScheduleSeatRepositoryInterface;
use App\Interfaces\TicketRepositoryInterface;

class TicketController extends Controller
{
    private TicketRepositoryInterface $ticketRepository;
    private ScheduleSeatRepositoryInterface $seatRepository;

    public function __construct(
        TicketRepositoryInterface $ticketRepository,
        ScheduleSeatRepositoryInterface $seatRepository
    ) {
        $this->ticketRepository = $ticketRepository;
        $this->seatRepository = $seatRepository;
    }

    public function order($scheduleId)
    {
        $seats = $this->seatRepository->getSeatBySchedule($scheduleId);

        return view('pages.ticket.order', compact('seats'));
    }

    public function createTicket(CreateTicketRequest $request)
    {
        try {
            $this->ticketRepository->createOrder($request['schedule_id'], $request['seat_id']);

            return redirect()->route('ticket.confirmation')->with('success', 'Ticket berhasil dipesan!');
        } catch (\Exception $e) {
            return redirect()->route('ticket.confirmation')->with('error', $e->getMessage());
        }
    }
}
