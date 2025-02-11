<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // Create user
        $record = static::getModel()::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'kelas' => $data['kelas'] ?? null,
            'jurusan' => $data['jurusan'] ?? null,
        ]);

        // Sync roles
        if (isset($data['roles']) && is_array($data['roles'])) {
            $roles = Role::whereIn('id', $data['roles'])->get();
            if ($roles->isEmpty()) {
                // Default to Pengunjung role if no valid roles provided
                $pengunjungRole = Role::where('name', 'Pengunjung')->first();
                if ($pengunjungRole) {
                    $record->assignRole($pengunjungRole);
                }
            } else {
                $record->syncRoles($roles);
            }
        } else {
            // Assign default Pengunjung role
            $pengunjungRole = Role::where('name', 'Pengunjung')->first();
            if ($pengunjungRole) {
                $record->assignRole($pengunjungRole);
            }
        }

        return $record;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Remove password confirmation field
        unset($data['password_confirmation']);
        return $data;
    }
}
