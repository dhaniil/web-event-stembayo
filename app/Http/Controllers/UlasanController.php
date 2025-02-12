<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:255'
        ]);

        DB::beginTransaction();
        try {


            $ulasan = new Ulasan();
            $ulasan->user_id = Auth::id();
            $ulasan->event_id = $request->event_id;
            $ulasan->rating = $request->rating;
            $ulasan->komentar = $request->komentar;
            $ulasan->save();

            DB::commit();
            return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();

        }
    }
}