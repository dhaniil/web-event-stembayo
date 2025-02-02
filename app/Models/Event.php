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
            return asset('images/placeholder.jpg'); // Pastikan ada gambar placeholder
        }
        
        // Jika image adalah URL lengkap
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }
        
        // Jika image disimpan di storage
        return Storage::disk('public')->exists($this->image) 
            ? Storage::disk('public')->url($this->image)
            : asset('images/placeholder.jpg');
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

    public function berita()
    {
        return $this->hasOne(Berita::class);
    }


}
