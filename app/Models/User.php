<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, HasRoles, Notifiable;
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('user')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'nomer',
        'kelas',
        'jurusan',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        if ($this->hasRole('Super Admin')) {
            return true;
        }
        if ($this->hasAnyRole(['Admin', 'Sekbid'])) {
            return $this->hasAnyPermission([
                'view_admin',
                'view_sekbid',
                'view_event',
                'view_berita',
                'view_ulasan',
                'view_activity_log'
            ]);
        }

        return false;
    }

    public function isSuperadmin(): bool
    {
        return $this->hasRole('Super Admin');
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('Admin');
    }

    public function isSekbid(): bool
    {
        return $this->hasRole('Sekbid');
    }

    public function isPengunjung(): bool
    {
        return $this->hasRole('Pengunjung');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favourites()
    {
        return $this->belongsToMany(Event::class, 'favourites', 'user_id', 'events_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
