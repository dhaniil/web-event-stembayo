<?php

namespace App\Filament\Resources\EventBannerResource\Pages;

use App\Filament\Resources\EventBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEventBanner extends CreateRecord
{
    protected static string $resource = EventBannerResource::class;
}
