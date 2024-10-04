<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::query(); // Mulai query builder

        if ($request->has('month') && $request->has('year')) {
            $events = $events->whereMonth('date', $request->month)
                             ->whereYear('date', $request->year);
        }

        $events = $events->get(); // Ambil data setelah filtering

        return view('events.dashboard', compact('events')); // Pass events to the view
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'type' => 'required|string',
            'image_url' => 'nullable|url', // Allow image_url to be optional
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }


}