<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function tambahStok(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->tambahStok($request->jumlah, $request->tanggal);

        return response()->json(['message' => 'Stok berhasil ditambah']);
    }

    public function kurangiStok(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->kurangiStok($request->jumlah, $request->tanggal);

        return response()->json(['message' => 'Stok berhasil dikurangi']);
    }
}
