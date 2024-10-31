<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

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
            'jam_mulai' => 'required|date_format:H:i',
            'end_date' => 'required|date',
            'jam_selesai' => 'required|date_format:H:i',
            'description' => 'required|string',
            'tempat' => 'required|string|max:255',
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
            'jam_mulai' => $request->jam_mulai,
            'end_date' => $request->end_date,
            'jam_selesai' => $request->jam_selesai,
            'description' => $request->description,
            'tempat' => $request->tempat,
            'type' => $request->type,
            'image' => $imagePath,
            'kategori' => $request->kategori,
            'penyelenggara' => $request->penyelenggara,
        ]);

        return redirect()->route('events.dashboard')->with('success', 'Event berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'end_date' => 'required|date',
            'jam_selesai' => 'required|date_format:H:i',
            'description' => 'required|string',
            'tempat' => 'required|string|max:255',
            'type' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'kategori' => 'required|in:KTYME Islam,KTYME Kristiani,KBBP,KBPL,BPPK,KK,PAKS,KJDK,PPBN,HUMTIK',
            'penyelenggara' => 'required|string|max:255',
        ]);

        $event = Event::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $event->image = $imagePath;
        }

        $event->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'jam_mulai' => $request->jam_mulai,
            'end_date' => $request->end_date,
            'jam_selesai' => $request->jam_selesai,
            'description' => $request->description,
            'tempat' => $request->tempat,
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

    public function storeReview(Request $request, $eventId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        $event = Event::findOrFail($eventId);

        // Menyimpan review ke database
        $event->reviews()->create([
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('events.show', $eventId)
            ->with('success', 'Review berhasil ditambahkan');
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
    
        $user = Auth::user();

        // Kirim data event dan filter yang diterapkan ke view
        return view('events.eventonly', compact('user', 'events', 'tanggal', 'kategori'));
        return view('layout.sidebar', compact('user'));
    }

    public function SidebarInfo()
    {

    }
}
