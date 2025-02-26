<?php

namespace App\Http\Controllers;

use App\Models\EventBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EventBannerController extends Controller
{
    /**
     * Standard banner dimensions
     * 19:6 aspect ratio with reasonable web dimensions
     */
    const BANNER_WIDTH = 1140;  // Width in pixels (19 units)
    const BANNER_HEIGHT = 360;  // Height in pixels (6 units)

    /**
     * Display a listing of the event banners.
     */
    public function index()
    {
        $banners = EventBanner::orderBy('created_at', 'desc')->get();
        return view('banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new event banner.
     */
    public function create()
    {
        return view('banners.create');
    }

    /**
     * Store a newly created event banner in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $banner = new EventBanner();
        
        if ($request->hasFile('image')) {
            // Get uploaded image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Process and resize image to standard dimensions
            $img = Image::make($image);
            $img->fit(self::BANNER_WIDTH, self::BANNER_HEIGHT, function ($constraint) {
                $constraint->upsize();
            });
            
            // Save processed image
            $path = storage_path('app/public/event-banners/' . $imageName);
            $img->save($path);
            
            $banner->image = 'event-banners/' . $imageName;
        }

        $banner->save();

        return back()->with('success', 'Banner berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified event banner.
     */
    public function edit(EventBanner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    /**
     * Update the specified event banner in storage.
     */
    public function update(Request $request, EventBanner $banner)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            
            // Store new image
            $imagePath = $request->file('image')->store('event-banners', 'public');
            $banner->image = $imagePath;
        }

        $banner->save();

        return redirect()->route('banners.index')->with('success', 'Banner berhasil diperbarui!');
    }

    /**
     * Remove the specified event banner from storage.
     */
    public function destroy(EventBanner $banner)
    {
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }
        
        $banner->delete();

        return back()->with('success', 'Banner berhasil dihapus!');
    }

    /**
     * Get all active banners for the carousel display
     */
    public function getBannersForCarousel()
    {
        $banners = EventBanner::orderBy('created_at', 'desc')->get();
        return response()->json($banners);
    }

    /**
     * Get active banners for display on the dashboard with debugging
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActiveBanners()
    {
        $banners = EventBanner::orderBy('created_at', 'desc')->get();
        
        // Log banner count and details
        Log::info('EventBannerController - Banner count: ' . $banners->count());
        
        if ($banners->count() > 0) {
            foreach ($banners as $index => $banner) {
                Log::info("EventBannerController - Banner #{$index}: ID={$banner->id}, Image={$banner->image}");
                
                // Verify image exists
                if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                    Log::info("EventBannerController - Image exists: {$banner->image}");
                } else {
                    Log::warning("EventBannerController - Image missing: {$banner->image}");
                }
            }
        } else {
            Log::warning('EventBannerController - No banners found in database');
        }
        
        return $banners;
    }
    
    /**
     * Check banner display in the dashboard
     */
    public function checkBannerDisplay()
    {
        $banners = $this->getActiveBanners();
        return response()->json([
            'success' => true,
            'count' => $banners->count(),
            'banners' => $banners->map(function($banner) {
                return [
                    'id' => $banner->id,
                    'image' => $banner->image,
                    'image_exists' => $banner->image && Storage::disk('public')->exists($banner->image),
                    'image_url' => $banner->image ? asset('storage/' . $banner->image) : null,
                ];
            })
        ]);
    }
}