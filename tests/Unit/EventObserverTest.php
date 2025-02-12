<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Event;
use Carbon\Carbon;

class EventObserverTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Fix the current time for testing
        Carbon::setTestNow('2025-02-11 13:00:00');
    }

    public function test_event_status_updates_correctly()
    {
        // Create event happening now
        $currentEvent = Event::create([
            'name' => 'Current Event',
            'start_date' => Carbon::now()->format('Y-m-d'),
            'end_date' => Carbon::now()->format('Y-m-d'),
            'jam_mulai' => Carbon::now()->subMinutes(5)->format('H:i:s'), // 12:55:00
            'jam_selesai' => Carbon::now()->addHour()->format('H:i:s'),  // 14:00:00
        ]);
        
        // Debug information
        dump([
            'now' => Carbon::now()->format('Y-m-d H:i:s'),
            'start' => $currentEvent->start_date . ' ' . $currentEvent->jam_mulai,
            'end' => $currentEvent->end_date . ' ' . $currentEvent->jam_selesai,
            'status' => $currentEvent->status
        ]);

        // Event should be "sedang berlangsung"
        $this->assertEquals('sedang berlangsung', $currentEvent->status);

        // Create future event
        $futureEvent = Event::create([
            'name' => 'Future Event',
            'start_date' => Carbon::now()->addDay()->format('Y-m-d'),
            'end_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
            'jam_mulai' => '09:00:00',
            'jam_selesai' => '17:00:00',
        ]);

        // Event should be "belum mulai"
        $this->assertEquals('belum mulai', $futureEvent->status);

        // Create past event
        $pastEvent = Event::create([
            'name' => 'Past Event',
            'start_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
            'end_date' => Carbon::now()->subDay()->format('Y-m-d'),
            'jam_mulai' => '09:00:00',
            'jam_selesai' => '17:00:00',
        ]);

        // Event should be "selesai"
        $this->assertEquals('selesai', $pastEvent->status);
    }

    protected function tearDown(): void
    {
        // Reset the mock time
        Carbon::setTestNow();
        parent::tearDown();
    }
}