<?php

namespace App\Repositories;

use App\Interfaces\TicketRepositoryInterface;
use App\Models\Ticket;
use Carbon\Carbon;

class TicketRepository implements TicketRepositoryInterface
{
    public function createOrder($scheduleId, $seatId)
    {
        $studentId = auth()->id();

        $now = Carbon::now('Asia/Makassar');
        $startOfWeek = $now->copy()->startOfWeek();
        $endOfWeek = $now->copy()->endOfWeek();

        $successCount = Ticket::where('student_id', $studentId)
            ->where('status', 'success')
            ->whereBetween('booking_date', [$startOfWeek, $endOfWeek])
            ->count();

        if ($successCount >= 2) {
            throw new \Exception('Anda sudah mencapai limit pemesanan ticket untuk minggu ini');
        }

        $code = 'DUPRES-' . uniqid();

        return Ticket::create([
            'code' => $code,
            'schedule_id' => $scheduleId,
            'student_id' => $studentId,
            'seat_id' => $seatId,
            'booking_date' => now('Asia/Makassar'),
            'status' => 'success',
            'tokenMidtrans' => $code
        ]);
    }
}
