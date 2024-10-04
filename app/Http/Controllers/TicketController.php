<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use PDF; // Jika menggunakan library untuk QR Code

class TicketController extends Controller
{
    public function purchase(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);

        $ticket = Ticket::create([
            'event_id' => $eventId,
            'user_id' => auth()->id(), // Pastikan user terautentikasi
            'price' => $event->price,
            'type' => $request->input('type'),
            'valid_until' => now()->addDays(30), // Masa berlaku 30 hari
        ]);

        // Buat QR Code di sini menggunakan library yang diinginkan
        // Contoh: $pdf = PDF::loadView('ticket', compact('ticket'));
        // return $pdf->download('ticket.pdf');

        return redirect()->route('events.show', $eventId)->with('success', 'Tiket berhasil dibeli!');
    }
}
