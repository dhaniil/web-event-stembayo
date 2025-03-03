<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;


class Event extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'description', 'location', 'category', 'start_date', 'end_date', 'status'])
            ->setDescriptionForEvent(fn(string $eventName) => "Event telah {$eventName}")
            ->useLogName('event')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    use HasFactory, Searchable;

    public function toSearchableArray()
    {
        return [
            'title' => $this->name, // menggunakan name karena itu adalah field judul di tabel events
            'description' => $this->description,
            'type' => $this->type,
            'kategori' => $this->kategori,
            'penyelenggara' => $this->penyelenggara
        ];
    }

    public function shouldBeSearchable()
    {
        return true; // memastikan semua event dapat dicari
    }

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
            ? asset(Storage::url($this->image))
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
    public function banners()
    {
        return $this->hasMany(EventBanner::class);
    }

}
