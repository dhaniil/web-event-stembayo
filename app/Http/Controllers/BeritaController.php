<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Event;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('event')->latest()->get();
        return view('berita.index', compact('berita'));
    }

    public function show(Berita $berita)
    {
        // Mendapatkan event lain dari penyelenggara yang sama
        $eventTerkait = Event::where('penyelenggara', $berita->event->penyelenggara)
                            ->where('id', '!=', $berita->event_id)
                            ->with('berita')
                            ->limit(5)
                            ->get();
    
        return view('berita.show', compact('berita', 'eventTerkait'));
    }

    public function create()
    {
        $events = Event::where('end_date', '<', now())->get(); // Hanya event yang sudah selesai
        return view('berita.create', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'judul' => 'required|string|max:255',
            'isi' => 'required',
        ]);

        Berita::create($request->all());

        return redirect()->route('berita.index')->with('success', 'Berita event berhasil ditambahkan!');
    }
}

