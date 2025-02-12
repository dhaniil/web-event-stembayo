<?php

namespace App\Observers;

use App\Models\Event;
use Carbon\Carbon;

class EventObserver
{
    public function creating(Event $event)
    {
        $this->updateEventStatus($event);
    }

    public function updating(Event $event)
    {
        $this->updateEventStatus($event);
    }

    private function updateEventStatus(Event $event)
    {
        $now = Carbon::now();
        $startDateTime = Carbon::parse($event->start_date . ' ' . $event->jam_mulai);
        $endDateTime = Carbon::parse($event->end_date . ' ' . $event->jam_selesai);

        if ($now->gt($endDateTime)) {
            $event->status = 'selesai';
        } elseif ($now->gte($startDateTime) && $now->lte($endDateTime)) {
            $event->status = 'sedang berlangsung';
        } else {
            $event->status = 'belum mulai';
        }
    }
}
