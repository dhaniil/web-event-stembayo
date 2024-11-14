<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori'; // Pastikan nama tabel sesuai
    use HasFactory;
    protected $fillable = ['kategori', 'deskripsi'];
    public function barang() {
        return $this->hasMany(Barang::class);
    }
    
}
