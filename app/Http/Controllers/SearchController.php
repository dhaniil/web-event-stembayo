<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');
        $wantsJson = $request->ajax() || $request->wantsJson();
        
        if (strlen($query) < 2) {
            if ($wantsJson) {
                return response()->json([
                    'events' => [],
                    'berita' => []
                ]);
            }
            return redirect()->back()->with('error', 'Kata kunci pencarian minimal 2 karakter');
        }

        // Pencarian Event menggunakan field 'name' sebagai judul
        $events = Event::search($query)
            ->query(function ($builder) {
                return $builder->where('status', '!=', 'draft');
            });

        // Pencarian Berita
        $berita = Berita::search($query)
            ->query(function ($builder) {
                return $builder->where('status', 'published');
            });

        if ($wantsJson) {
            $events = $events->take(5)->get()
                ->map(function($event) {
                    return [
                        'id' => $event->id,
                        'title' => $event->name, // menggunakan name untuk judul event
                        'url' => route('events.show', $event->id),
                        'type' => 'event',
                        'description' => Str::limit($event->description, 100)
                    ];
                });

            $berita = $berita->take(5)->get()
                ->map(function($berita) {
                    return [
                        'id' => $berita->id,
                        'title' => $berita->title,
                        'url' => route('berita.show', $berita->slug),
                        'type' => 'berita',
                        'excerpt' => Str::limit($berita->excerpt, 100)
                    ];
                });

            return response()->json([
                'events' => $events,
                'berita' => $berita
            ]);
        }

        // For full page search results
        $events = $events->paginate(9);
        $berita = $berita->paginate(9);

        return view('search.results', compact('events', 'berita', 'query'));
    }
}
