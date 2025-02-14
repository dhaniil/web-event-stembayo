<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;
use Spatie\Activitylog\Contracts\Activity;

class ActivityLog extends Model implements Activity
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

    /**
     * Get an extra property for the activity
     */
    public function getExtraProperty(string $propertyName, mixed $defaultValue): mixed
    {
        return data_get($this->properties, $propertyName, $defaultValue);
    }

    /**
     * Get the changes recorded in the activity
     */
    public function changes(): Collection
    {
        if (!isset($this->properties['attributes'])) {
            return collect([]);
        }

        return collect([
            'old' => $this->properties['old'] ?? [],
            'attributes' => $this->properties['attributes'] ?? [],
        ]);
    }

    /**
     * Scope activities to those in a specific log
     */
    public function scopeInLog(Builder $query, ...$logNames): Builder
    {
        if (is_array($logNames[0])) {
            $logNames = $logNames[0];
        }

        return $query->whereIn('log_name', $logNames);
    }

    /**
     * Scope activities caused by a specific model
     */
    public function scopeCausedBy(Builder $query, Model $causer): Builder
    {
        return $query
            ->where('causer_type', $causer->getMorphClass())
            ->where('causer_id', $causer->getKey());
    }

    /**
     * Scope activities for a specific event
     */
    public function scopeForEvent(Builder $query, string $event): Builder
    {
        return $query->where('event', $event);
    }

    /**
     * Scope activities for a specific subject
     */
    public function scopeForSubject(Builder $query, Model $subject): Builder
    {
        return $query
            ->where('subject_type', $subject->getMorphClass())
            ->where('subject_id', $subject->getKey());
    }
}
