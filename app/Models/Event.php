<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'created_at',
        'updated_at',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getImageUrlAttribute()
    {
        return cache()->rememberForever("event-image-url-{$this->id}", function () {
            return $this->image
                ? Storage::url('events/' . $this->image)
                : 'https://via.placeholder.com/300x200';
        });
    }


    public function favouritedBy()
    {
        return $this->belongsToMany(User::class, 'favourites');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class);
    }

}
