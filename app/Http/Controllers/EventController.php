<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil 4 event teratas
        $events = Event::all();
        // $events = Event::take(4)->get();
    
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
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|string',
            'type' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096', 
            'kategori' => 'required|in:KTYME Islam,KTYME Kristiani,KBBP,KBPL,BPPK,KK,PAKS,KJDK,PPBN,HUMTIK',
            'penyelenggara' => 'required|string|max:255', 
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Event::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            "end_date" => $request->end_date,
            'description' => $request->description,
            'type' => $request->type,
            'image' => $imagePath,
            'kategori' => $request->kategori,
            'penyelenggara' => $request->penyelenggara,
        ]);

        return redirect()->route('events.dashboard')->with('success', 'Event berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

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

        return view('events.edit', compact('event', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|string',
            'type' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'kategori' => 'required|in:KTYME Islam,KTYME Kristiani,KBBP,KBPL,BPPK,KK,PAKS,KJDK,PPBN,HUMTIK',
            'penyelenggara' => 'required|string|max:255',
        ]);

        $event = Event::findOrFail($id);

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $event->image = $imagePath; // Simpan path gambar baru
        }

        // Update data event
        $event->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'type' => $request->type,
            'kategori' => $request->kategori,
            'penyelenggara' => $request->penyelenggara,
        ]);

        return redirect()->route('events.dashboard')->with('success', 'Event berhasil diperbarui!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function EventPage(Request $request)
    {
        // Ambil filter dari input request
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
    
        // Mulai query
        $query = Event::query();
    
        // Filter berdasarkan tanggal jika ada
        if ($tanggal) {
            $query->whereDate('start_date', '<=', $tanggal)
                  ->whereDate('end_date', '>=', $tanggal);
        }
    
        // Filter berdasarkan kategori jika ada
        if ($kategori) {
            $query->where('kategori', $kategori);
        }
    
        // Dapatkan event berdasarkan filter atau semua data jika tidak ada filter
        $events = $query->get();
    
        // Kirim data event dan filter yang diterapkan ke view
        return view('events.eventonly', compact('events', 'tanggal', 'kategori'));
    }
    
}
