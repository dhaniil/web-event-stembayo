<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class TestPage extends Page
{
    protected static ?string $navigationLabel = 'Test Page';
    protected static string $view = 'filament.test-page';

    // Judul halaman
    protected static ?string $title = 'Halaman Uji Coba';
}
