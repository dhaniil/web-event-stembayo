<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;


class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $appends = ['image_url'];

    protected $fillable = [
        'name',
        'start_date',
        'jam_mulai',
        'end_date',
        'jam_selesai',
        'status',
        'description',
        'tempat',
        'type',
        'image',
        'kategori',
        'penyelenggara',
        'visit_count',
        'created_at',
        'updated_at',
    ];


    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://via.placeholder.com/300x200';
        }

        // Gunakan URL lengkap
        $baseUrl = config('app.url');
        return $baseUrl . '/storage/' . $this->image;
    }

    public function pengunjung()
    {
        return $this->hasMany(Pengunjung::class);
    }
    public function favouritedBy()
    {
        return $this->belongsToMany(User::class, 'favourites', 'events_id', 'user_id');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class);
    }

}
