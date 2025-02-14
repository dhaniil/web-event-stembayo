<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Models\Berita;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap';

    public function handle()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Add static routes
        $staticUrls = [
            '/',
            '/events',
            '/berita',
        ];

        foreach ($staticUrls as $url) {
            $sitemap .= '
    <url>
        <loc>' . url($url) . '</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>';
        }

        // Add dynamic events
        $events = Event::all();
        foreach ($events as $event) {
            $sitemap .= '
    <url>
        <loc>' . url("/events/{$event->id}") . '</loc>
        <lastmod>' . $event->updated_at->format('Y-m-d\TH:i:sP') . '</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>';
        }

        // Add dynamic news
        $news = Berita::all();
        foreach ($news as $item) {
            $sitemap .= '
    <url>
        <loc>' . url("/berita/{$item->id}") . '</loc>
        <lastmod>' . $item->updated_at->format('Y-m-d\TH:i:sP') . '</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>';
        }

        $sitemap .= '
</urlset>';

        file_put_contents(public_path('sitemap.xml'), $sitemap);
        $this->info('Sitemap generated successfully!');
    }
}
