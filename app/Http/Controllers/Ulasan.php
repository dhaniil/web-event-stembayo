<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|min:10',
        ]);

        $ulasan = Ulasan::create([
            'user_id' => Auth::id(),
            'event_id' => $request->event_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan');
    }

    public function destroy(Ulasan $ulasan)
    {
        if ($ulasan->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action');
        }

        $ulasan->delete();
        return redirect()->back()->with('success', 'Ulasan berhasil dihapus');
    }
}