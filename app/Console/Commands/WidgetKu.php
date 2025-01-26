<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WidgetKu extends Command
{

    protected $signature = 'app:widget-ku';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $name = 'make:custom-widget';
    protected $description = 'Create a new Filament widget using custom template';
    protected $type = 'Widget';

    protected function getStub(): string
    {
        // Gunakan stub custom untuk widget
        return base_path('stubs/filament-widget.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Filament\Widgets';
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
