<?php

namespace App\Console\Commands;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateEventStatus extends Command
{
    protected $signature = 'events:update-status';
    protected $description = 'Update status for all events based on their dates';

    public function handle()
    {
        $events = Event::all();
        $now = Carbon::now();

        foreach ($events as $event) {
            $startDateTime = Carbon::parse($event->start_date . ' ' . $event->jam_mulai);
            $endDateTime = Carbon::parse($event->end_date . ' ' . $event->jam_selesai);

            if ($now->gt($endDateTime)) {
                $event->status = 'selesai';
            } elseif ($now->between($startDateTime, $endDateTime)) {
                $event->status = 'sedang berlangsung';
            } else {
                $event->status = 'belum mulai';
            }

            $event->save();
        }

        $this->info('Event statuses updated successfully');
    }
}