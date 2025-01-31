<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Pengunjung;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TrackPengunjung
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $event = $request->route('event');
            
            if ($event instanceof Event) {
                $existingVisit = Pengunjung::where('event_id', $event->id)
                    ->where('ip_address', $request->ip())
                    ->where('visited_at', '>', now()->subHours(24))
                    ->exists();
                
                if (!$existingVisit) {
                    Pengunjung::create([
                        'event_id' => $event->id,
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent(),
                        'visited_at' => now(),
                    ]);

                    $event->increment('visit_count');
                    
                    Log::info('Visit tracked', [
                        'event_id' => $event->id,
                        'ip' => $request->ip(),
                        'visit_count' => $event->visit_count
                    ]);
                }
            }

            return $next($request);
        } catch (\Exception $e) {
            Log::error('Error tracking visitor: ' . $e->getMessage(), [
                'event_id' => $event->id ?? null,
                'ip' => $request->ip()
            ]);
            return $next($request);
        }
    }
}
