<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = ['merk', 'kategori_id', 'stok', 'seri', 'spesifikasi'];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }

    public function tambahStok($jumlah, $tanggal)
    {
        $this->stok += $jumlah;
        $this->save();

        BarangMasuk::create([
            'barang_id' => $this->id,
            'jumlah' => $jumlah,
            'tanggal_masuk' => $tanggal,
        ]);
    }

    public function kurangiStok($jumlah, $tanggal)
    {
        $this->stok -= $jumlah;
        $this->save();

        BarangKeluar::create([
            'barang_id' => $this->id,
            'jumlah' => $jumlah,
            'tanggal_keluar' => $tanggal,
        ]);
    }
}
