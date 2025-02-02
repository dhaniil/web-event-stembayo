<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaGallery extends Model
{
    protected $fillable = ['berita_id', 'image_path'];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}
