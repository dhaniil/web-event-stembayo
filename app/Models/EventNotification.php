<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventNotification extends Model
{
    protected $fillable = [
        'event_id',
        'notification_type',
        'is_sent'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function notifications()
{
    return $this->hasMany(EventNotification::class);
}

protected static function booted()
{
    static::created(function ($event) {
        $notificationTypes = [
            'month' => 30,
            'twoweeks' => 14,
            'week' => 7,
            'threedays' => 3,
            'oneday' => 1
        ];

        foreach ($notificationTypes as $type => $days) {
            EventNotification::create([
                'event_id' => $event->id,
                'notification_type' => $type,
                'is_sent' => false
            ]);
        }
    });
}
}