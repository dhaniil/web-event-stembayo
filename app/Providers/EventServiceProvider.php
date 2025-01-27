<?php

namespace App\Providers;

use App\Models\Event;
use App\Observers\EventObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\OptimizeImage;


class EventServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Event::observe(EventObserver::class);
    }
    protected $listen = [
        'Illuminate\Http\Events\FileUploaded' => [
            OptimizeImage::class,
        ],
    ];
}
