<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventBanner extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['event_id', 'image', 'order'])
            ->setDescriptionForEvent(function(string $eventName) {
                return match($eventName) {
                    'created' => 'Banner event baru telah ditambahkan',
                    'updated' => 'Banner event telah diperbarui',
                    'deleted' => 'Banner event telah dihapus',
                    default => "Banner event telah {$eventName}"
                };
            })
            ->useLogName('event_banner')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    use HasFactory;
    protected $fillable = [
        'image',
    ];

}
