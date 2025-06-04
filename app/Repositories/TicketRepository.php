<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\TicketRepositoryInterface;
use Asikam\QrCode\Facades\QrCode;

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

        $code = 'DUPRES-' . substr(uniqid(), 0, 5);

        return Ticket::create([
            'code' => $code,
            'schedule_id' => $scheduleId,
            'student_id' => $this->studentId,
            'seat_id' => $seatId,
            'booking_date' => now('Asia/Makassar'),
            'status' => 'pending',
            'tokenMidtrans' => $code
        ]);
    }

    public function checkUserTicketWeekly()
    {
        $now = Carbon::now('Asia/Makassar');
        $startOfWeek = $now->copy()->startOfWeek();
        $endOfWeek = $now->copy()->endOfWeek();

        $successCount = Ticket::where('student_id', $this->studentId)
            ->whereBetween('booking_date', [$startOfWeek, $endOfWeek])
            ->count();

        return $successCount;
    }

    public function checkSeatBook($scheduleId, $seatId)
    {
        $checkSeat = Ticket::where('schedule_id', $scheduleId)
            ->where('seat_id', $seatId)
            ->first();

        return $checkSeat;
    }

    public function checkUserBook($scheduleId)
    {
        $check = Ticket::where('schedule_id', $scheduleId)
            ->where('student_id', $this->studentId)
            ->count();

        return $check;
    }

    public function getTicketById($id)
    {
        return Ticket::where('student_id', auth()->id())
            ->where('id', $id)
            ->first();
    }

    public function generateQrCode($ticketCode)
    {
        $directory = public_path('storage/qrcodes/ticket/');
        $path = $directory . $ticketCode . '.png';

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        if (!file_exists($path)) {
            QrCode::format('png')->size(200)->generate($ticketCode, $path);
        }
    }

    public function confirmTicket($code)
    {
        $ticket = Ticket::where('code', $code)->first();

        if (!$ticket || $ticket->status == 'failed') {
            return [
                'status' => 'error',
                'message' => 'Tiket tidak terdaftar'
            ];
        }

        if ($ticket->status == 'success') {
            return [
                'status' => 'error',
                'message' => 'Tiket sudah kadaluarsa'
            ];
        }

        $ticket->status = 'success';
        $ticket->save();

        return [
            'status' => 'success',
            'message' => 'Tiket dengan code ' . $code . ' telah digunakan.'
        ];
    }
}
