<?php

namespace App\Interfaces;

interface TicketRepositoryInterface
{
    public function getTicketUser($studentId);

    public function createOrder($scheduleId, $seatId);

    public function checkUserTicketWeekly();

    public function checkSeatBook($scheduleId, $seatId);

    public function checkUserBook($scheduleId);

    public function getTicketById($id);

    public function generateQrCode($ticketCode);
}
