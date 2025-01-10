<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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
        'role' => 'string',
    ];

    public static $roles = [
        'admin',
        'sekbid',
    ];

    public static function isValidRole($role)
    {
        return in_array($role, self::$roles);
    }

    /**
     * Check if the user has admin role.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user has sekbid role.
     *
     * @return bool
     */
    public function isSekbid(): bool
    {
        return $this->role === 'sekbid';
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }  
    
    public function favourites()
    {
        return $this->belongsToMany(Event::class, 'favourites', 'user_id', 'events_id'); // Menggunakan nama kolom yang benar
    }
}

