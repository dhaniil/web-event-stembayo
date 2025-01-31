<?php

namespace App\Console\Commands;

use App\Models\EventNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendEventNotifications extends Command
{
    protected $signature = 'events:send-notifications';
    protected $description = 'Send notifications for upcoming events';

    public function handle()
    {
        $notifications = EventNotification::with('event')
            ->where('is_sent', false)
            ->get();

        foreach ($notifications as $notification) {
            $event = $notification->event;
            $startDate = Carbon::parse($event->start_date);
            $today = Carbon::now();
            
            $daysUntilEvent = $today->diffInDays($startDate, false);
            
            $shouldSend = match($notification->notification_type) {
                'month' => $daysUntilEvent === 30,
                'twoweeks' => $daysUntilEvent === 14,
                'week' => $daysUntilEvent === 7,
                'threedays' => $daysUntilEvent === 3,
                'oneday' => $daysUntilEvent === 1,
                default => false,
            };

            if ($shouldSend) {
                $this->sendBrowserNotification($event, $daysUntilEvent);
                $notification->update(['is_sent' => true]);
            }
        }
    }

    private function sendBrowserNotification($event, $days)
    {
        $message = match($days) {
            30 => "Event {$event->name} akan dimulai dalam 1 bulan",
            14 => "Event {$event->name} akan dimulai dalam 2 minggu",
            7 => "Event {$event->name} akan dimulai dalam 1 minggu",
            3 => "Event {$event->name} akan dimulai dalam 3 hari",
            1 => "Event {$event->name} akan dimulai besok",
            default => "Event {$event->name} akan segera dimulai",
        };

        // Broadcast event untuk notifikasi browser
        broadcast(new EventNotification($message));
    }
}