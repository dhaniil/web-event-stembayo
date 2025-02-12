<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berita extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'content', 'status', 'published_at', 'featured_image'])
            ->setDescriptionForEvent(fn(string $eventName) => "Berita telah {$eventName}")
            ->useLogName('berita')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    use HasFactory, SoftDeletes;

    protected $table = 'berita';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category',
        'published_at',
        'status',
        'author_id',
        'views'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views' => 'integer'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}
