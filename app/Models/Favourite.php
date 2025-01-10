<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $table = 'favourites';
    protected $fillable = ['user_id', 'events_id']; // Menggunakan nama kolom yang benar

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id'); // Menggunakan nama kolom yang benar
    }
}
