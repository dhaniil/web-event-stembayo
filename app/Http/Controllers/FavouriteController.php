<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Favourite;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function favourite($eventId)
    {
        try {
            $event = Event::findOrFail($eventId);
            
            // Check if already favorited
            $existing = Favourite::where('user_id', Auth::id())
                               ->where('events_id', $eventId)
                               ->first();
            
            if ($existing) {
                return redirect()->back()->with('error', 'Event already in favorites');
            }

            // Create new favorite
            Favourite::create([
                'user_id' => Auth::id(),
                'events_id' => $eventId
            ]);

            return redirect()->back()->with('success', 'Event added to favorites');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add favorite');
        }
    }

    public function unfavourite($eventId)
    {
        try {
            $favourite = Favourite::where('user_id', Auth::id())
                                ->where('events_id', $eventId)
                                ->firstOrFail();
            
            $favourite->delete();

            return redirect()->back()->with('success', 'Event removed from favorites');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to remove favorite');
        }
    }

    public function favouriteEvents()
    {
        $favourites = Favourite::with('event')
                             ->where('user_id', Auth::id())
                             ->paginate(10);

        $user = Auth::user();

        return view('favourites.index', compact('favourites', 'user'));
    }
}