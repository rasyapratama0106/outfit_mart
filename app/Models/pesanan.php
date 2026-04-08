<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
    'nama_pembeli',
    'alamat',
    'nama_barang',
    'total_harga',
    'ukuran',
    'image',
    'status',
    'bukti',
    'metode' // 🔥 INI YANG KAMU LUPA
];
}