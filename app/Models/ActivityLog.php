<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ActivityLog extends Model
{
    protected $table = 'activity_log';

    protected $fillable = [
        'log_name',
        'description',
        'subject_type',
        'subject_id',
        'causer_type',
        'causer_id',
        'properties'
    ];

    protected $casts = [
        'properties' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the subject model of the activity
     */
    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the causer model of the activity
     */
    public function causer(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope a query to filter activities by date range
     */
    public function scopeInDateRange($query, $from, $to)
    {
        return $query->when($from, function ($query, $date) {
            return $query->whereDate('created_at', '>=', $date);
        })->when($to, function ($query, $date) {
            return $query->whereDate('created_at', '<=', $date);
        });
    }

    /**
     * Scope a query to filter activities by log name
     */
    public function scopeWithLogName($query, $logName)
    {
        return $query->where('log_name', $logName);
    }

    /**
     * Get formatted properties attribute
     */
    public function getFormattedPropertiesAttribute(): array
    {
        $properties = $this->properties;
        if (!is_array($properties)) {
            return [];
        }

        return [
            'old' => $properties['old'] ?? [],
            'attributes' => $properties['attributes'] ?? [],
            'changes' => collect($properties['attributes'] ?? [])->diffAssoc($properties['old'] ?? [])->toArray()
        ];
    }
}
