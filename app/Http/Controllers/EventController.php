<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::all();

        return view('events.dashboard', compact('events')); 
    }

    public function create()
    {

        $kategori = [
        'KTYME Islam',
        'KTYME Kristiani',
        'KBBP',
        'KBPL',
        'BPPK',
        'KK',
        'PAKS',
        'KJDK',
        'PPBN',
        'HUMTIK',
    ];

    return view('events.create', compact('kategori'));
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
            'type' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096', 
            'kategori' => 'required|in:KTYME Islam,KTYME Kristiani,KBBP,KBPL,BPPK,KK,PAKS,KJDK,PPBN,HUMTIK','-', 
            'penyelenggara' => 'required|string|max:255', 
        ]);

       
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Event::create([
            'name' => $request->name,
            'date' => $request->date,
            'description' => $request->description,
            'type' => $request->type,
            'image' => $imagePath,
            'kategori' => $request->kategori,
            'penyelenggara' => $request->penyelenggara,
        ]);

        return redirect()->route('events.dashboard')->with('success', 'Event berhasil ditambahkan!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function EventPage()
    {
        $events = Event::all();
        return view('events.eventonly', compact('events'));
    }
    
}
