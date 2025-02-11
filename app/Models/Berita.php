<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'isi',
    ];


    public function galleries()
    {
        return $this->hasMany(BeritaGallery::class);
    }
}
