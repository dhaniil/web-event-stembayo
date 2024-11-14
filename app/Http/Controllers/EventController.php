<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{

    // Fungsi untuk menampilkan halaman dashboard
    public function index(Request $request)
    {
        $events = Event::all();
        return view('events.dashboard', compact('events'));
    }

    // Fungsi untuk menampilkan form create event
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
            '-',
        ];
        return view('events.create', compact('kategori'));
    }

    // Fungsi untuk menyimpan event baru
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
            'kategori' => 'required|in:KTYME Islam,KTYME Kristiani,KBBP,KBPL,BPPK,KK,PAKS,KJDK,PPBN,HUMTIK,-',
            'penyelenggara' => 'required|string|max:255',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // simpan gambar /app/public/images
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

        return redirect()->route('events.dashboard')->with('success');
    }

    // Fungsi untuk menampilkan halaman edit event
    public function edit($id)
    {
        $event = Event::findOrFail($id);

        // Pastikan user yang login adalah admin
        if (Gate::denies('admin-access')) {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

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
            '-',
        ];

        return view('events.edit', compact('event', 'kategori'));
    }

    // Fungsi untuk memperbarui event
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
            'kategori' => 'required|in:KTYME Islam,KTYME Kristiani,KBBP,KBPL,BPPK,KK,PAKS,KJDK,PPBN,HUMTIK,-',
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

        return redirect()->route('events.dashboard')->with('success', 'Data berhasil diperbarui!');
    }

    // Fungsi untuk menampilkan detail event
    public function show($id)
    {
        $event = Event::findOrFail($id);
        $user = Auth::user();
        return view('events.show', compact('event', 'user'));
    }

    // Fungsi untuk menyimpan review
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
            ->with('success');
    }

    // Fungsi untuk halaman event dengan filter
    public function EventPage(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $kategori = $request->input('kategori');
    
        $query = Event::query();
    
        // Filter tanggal
        if ($tanggal) {
            $query->whereDate('start_date', '<=', $tanggal)
                  ->whereDate('end_date', '>=', $tanggal);
        }
    
        // Filter kategori
        if ($kategori) {
            $query->where('kategori', $kategori);
        }
    
        $events = $query->get();
    
        $user = Auth::user();

        return view('events.eventonly', compact('user', 'events', 'tanggal', 'kategori'));
    }
}
