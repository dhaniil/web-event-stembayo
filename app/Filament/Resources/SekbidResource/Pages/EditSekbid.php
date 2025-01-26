<?php

namespace App\Filament\Resources\SekbidResource\Pages;

use App\Filament\Resources\SekbidResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSekbid extends EditRecord
{
    protected static string $resource = SekbidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
