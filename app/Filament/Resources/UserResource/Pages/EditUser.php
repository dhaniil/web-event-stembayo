<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Update user data
        if (isset($data['password']) && !filled($data['password'])) {
            unset($data['password']);
        }
        $record->update($data);

        // Sync roles
        if (isset($data['roles']) && is_array($data['roles'])) {
            $roles = Role::whereIn('id', $data['roles'])->get();
            if ($roles->isNotEmpty()) {
                $record->syncRoles($roles);
            }
        }

        return $record;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Get current role IDs
        $data['roles'] = $this->record->roles()->pluck('id')->toArray();
        
        // Remove password fields
        unset($data['password']);
        unset($data['password_confirmation']);

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Remove password confirmation field
        unset($data['password_confirmation']);

        return $data;
    }
}
