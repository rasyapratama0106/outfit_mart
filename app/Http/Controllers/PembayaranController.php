<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function prosesPembayaran(Request $request)
{
    if (!Auth::check()) {
        return redirect('/login');
    }

    $request->validate([
        'payment' => 'required'
    ]);

    $metode = $request->payment;

    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('keranjang')
            ->with('error','Keranjang kosong');
    }

    // 🔥 AMBIL ITEM PERTAMA (AMAN BUAT UJIKOM)
    $item = array_values($cart)[0];

    $pesanan = Pesanan::create([
        'nama_pembeli' => Auth::user()->name,
        'alamat' => Auth::user()->alamat ?? '-',
        'nama_barang' => $item['name'],
        'total_harga' => $item['price'] * $item['qty'],
        'ukuran' => $item['size'],
        'image' => $item['image'],
        'metode' => $metode,
        'status' => 'diproses'
    ]);

    // 🔥 KOSONGKAN CART (BERSIH)
    session()->forget('cart');

    return view('barcode', [
    'metode' => $metode,
    'id' => $pesanan->id,
    'item' => $item // ✅ TAMBAHKAN INI
]);
}
}