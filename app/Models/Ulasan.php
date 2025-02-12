<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ulasan extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['user_id', 'event_id', 'rating', 'comment'])
            ->setDescriptionForEvent(fn(string $eventName) => "Ulasan telah {$eventName}")
            ->useLogName('ulasan')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected $table = 'ulasan';
    protected $fillable = ['user_id', 'events_id', 'komentar', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
