<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\UploadedFile;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class OptimizeImage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UploadedFile $file): void
    {
        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize($file->getPathname());
    }
}
