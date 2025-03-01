<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::where('status', 'published')
            ->when($request->has('tanggal'), function ($q) use ($request) {
                return $q->whereDate('published_at', $request->tanggal);
            })
            ->orderBy('published_at', 'desc');

        $beritas = $query->get();
        $user = Auth::user();

        return view('berita.index', compact('beritas', 'user'));
    }

    public function show(Berita $berita)
    {
        if ($berita->status !== 'published') {
            abort(404);
        }

        $berita->incrementViews();
        $user = Auth::user();

        return view('berita.show', compact('berita', 'user'));
    }
}
