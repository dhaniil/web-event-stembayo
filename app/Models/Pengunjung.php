<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Pengunjung extends Model
{
    protected $table = 'pengunjung';
    protected $fillable = [
        'event_id',
        'ip_address',
        'user_agent',
        'visited_at'
    ];
    protected $casts = [
        'visited_at' => 'datetime',
    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
