<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengunjung extends Model
{
    use LogsActivity;

    protected $table = 'pengunjung';
    
    protected $fillable = [
        'user_id',
        'event_id',
        'ip_address',
        'user_agent',
        'status',
        'visited_at',
        'attended_at'
    ];

    protected $casts = [
        'visited_at' => 'datetime',
        'attended_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['user_id', 'event_id', 'status', 'visited_at', 'attended_at'])
            ->setDescriptionForEvent(function(string $eventName) {
                $event = $this->event;
                $eventName = strtolower($eventName);
                return match($eventName) {
                    'created' => "Pengunjung baru mendaftar ke event '{$event->name}'",
                    'updated' => $this->getStatusDescription(),
                    'deleted' => "Pendaftaran dibatalkan untuk event '{$event->name}'",
                    default => "Data pengunjung telah {$eventName}"
                };
            })
            ->useLogName('pengunjung')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected function getStatusDescription(): string
    {
        if ($this->isDirty('attended_at')) {
            return $this->attended_at 
                ? "Pengunjung telah hadir di event '{$this->event->name}'"
                : "Kehadiran pengunjung dibatalkan di event '{$this->event->name}'";
        }
        
        if ($this->isDirty('status')) {
            return "Status pengunjung diubah menjadi '{$this->status}' untuk event '{$this->event->name}'";
        }

        return "Data pengunjung diperbarui untuk event '{$this->event->name}'";
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
