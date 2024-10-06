<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    protected $table = 'events';


    protected $fillable = [
        'name',
        'date',
        'description',
        'type',
        'image',
        'model',
        'penyelenggara',
        'created_at',
        'updated_at',
    ];


    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getImageUrlAttribute()
{
    if ($this->image) {

        return 'data:image/jpeg;base64,' . base64_encode($this->image);
    }

    return 'https://via.placeholder.com/300x200'; 
}
}

