<?php

namespace App\Observers;

use App\Models\Event;
use Carbon\Carbon;

class EventObserver
{
    public function updating(Event $event)
    {
        $now = Carbon::now();
        $startDateTime = Carbon::parse($event->start_date . ' ' . $event->jam_mulai);
        $endDateTime = Carbon::parse($event->end_date . ' ' . $event->jam_selesai);

        if ($now->gt($endDateTime)) {
            $event->status = 'selesai';
        } elseif ($now->between($startDateTime, $endDateTime)) {
            $event->status = 'sedang berlangsung';
        } else {
            $event->status = 'belum mulai';
        }
    }
}
