<?php

namespace App\Interfaces;

interface TicketRepositoryInterface
{
    public function createOrder($scheduleId, $seatId);
}
