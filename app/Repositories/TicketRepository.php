<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\TicketRepositoryInterface;

class TicketRepository implements TicketRepositoryInterface
{
    private $studentId = '';

    public function __construct()
    {
        $studentId = auth()->id();
    }

    public function getTicketUser($studentId)
    {
        return Ticket::where('student_id', $studentId)
            ->with('schedule')
            ->join('schedules', 'tickets.schedule_id', '=', 'schedules.id')
            ->orderBy('schedules.play_date', 'asc')
            ->orderBy('booking_date', 'asc')
            ->select('tickets.*')
            ->get();
    }

    public function createOrder($scheduleId, $seatId)
    {
        $successCount = $this->checkUserTicketWeekly();
        if ($successCount >= 2) {
            throw new \Exception('Anda sudah mencapai limit pemesanan ticket untuk minggu ini');
        }

        $checkSeat = $this->checkSeatBook($scheduleId, $seatId);
        if ($checkSeat) {
            throw new \Exception('Kursi sudah dipesan');
        }

        $checkUser = $this->checkUserBook($scheduleId);
        if ($checkUser >= 0) {
            throw new \Exception('Anda sudah memiliki tiket untuk jadwal ini');
        }

        $code = 'DUPRES-' . uniqid();

        return Ticket::create([
            'code' => $code,
            'schedule_id' => $scheduleId,
            'student_id' => $this->studentId,
            'seat_id' => $seatId,
            'booking_date' => now('Asia/Makassar'),
            'status' => 'success',
            'tokenMidtrans' => $code
        ]);
    }

    public function checkUserTicketWeekly()
    {
        $now = Carbon::now('Asia/Makassar');
        $startOfWeek = $now->copy()->startOfWeek();
        $endOfWeek = $now->copy()->endOfWeek();

        $successCount = Ticket::where('student_id', $this->studentId)
            ->where('status', 'success')
            ->whereBetween('booking_date', [$startOfWeek, $endOfWeek])
            ->count();

        return $successCount;
    }

    public function checkSeatBook($scheduleId, $seatId)
    {
        $checkSeat = Ticket::where('schedule_id', $scheduleId)
            ->where('seat_id', $seatId)
            ->where('status', 'success')
            ->first();

        return $checkSeat;
    }

    public function checkUserBook($scheduleId)
    {
        $check = Ticket::where('schedule_id', $scheduleId)
            ->where('student_id', $this->studentId)
            ->where('status', 'success')
            ->count();

        return $check;
    }
}
