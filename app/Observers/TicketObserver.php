<?php

namespace App\Observers;

use App\Models\ScheduleSeat;
use App\Models\Ticket;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {
        if ($ticket->seat_id) {
            $seat = ScheduleSeat::find($ticket->seat_id);
        }

        if ($ticket->isDirty('status') && $ticket->status === 'failed') {
            if ($seat) {
                $seat->is_booked = 0;
                $seat->save();
            }
        } elseif ($ticket->isDirty('status') && $ticket->status !== 'failed') {
            if ($seat) {
                $seat->is_booked = 1;
                $seat->save();
            }
        }
    }

    /**
     * Handle the Ticket "deleted" event.
     */
    public function deleted(Ticket $ticket): void
    {
        if ($ticket->seat_id) {
            $seat = ScheduleSeat::find($ticket->seat_id);
            if ($seat) {
                $seat->is_booked = 0;
                $seat->save();
            }
        }
    }

    /**
     * Handle the Ticket "restored" event.
     */
    public function restored(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "force deleted" event.
     */
    public function forceDeleted(Ticket $ticket): void
    {
        //
    }
}
