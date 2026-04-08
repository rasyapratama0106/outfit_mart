@extends('layouts.petugas')

@section('title', 'Data Transaksi')

@section('content')

@php
use App\Models\Pesanan;
$pesanans = Pesanan::whereNotNull('bukti')->get();
@endphp

<style>
.transaksi-box{
    background:#d9d9d9;
    padding:20px;
    border-radius:10px;
}

.transaksi-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;
    background:white;
    padding:15px 20px;
    border-radius:10px;
    margin-bottom:15px;
}

.transaksi-img{
    width:80px;
    height:80px;
    object-fit:cover;
    border-radius:10px;
}

.transaksi-info{
    flex:1;
    font-size:14px;
}

.transaksi-info b{
    font-size:15px;
}

.transaksi-right{
    text-align:right;
    min-width:160px;
}

.total-bayar{
    font-size:13px;
    color:#555;
}

.nominal{
    font-size:18px;
    font-weight:700;
    color:#1E3A8A;
    margin-bottom:8px;
    display:block;
}

.btn-proses{
    display:inline-block;
    margin-top:10px;
    padding:8px 18px;
    border:none;
    border-radius:20px;
    background:#1E3A8A;
    color:white;
    font-size:13px;
    text-decoration:none;
}

.btn-proses:hover{
    background:#16306f;
}
</style>

<div class="transaksi-box">

<b>Transaksi Masuk</b>

@forelse($pesanans as $p)

<div class="transaksi-item">

    {{-- GAMBAR PRODUK --}}
    @if($p->image)
        <img src="{{ asset('images/'.$p->image) }}" 
             class="transaksi-img"
             onerror="this.src='https://via.placeholder.com/80'">
    @else
        <img src="https://via.placeholder.com/80" class="transaksi-img">
    @endif

    <div class="transaksi-info">
        <b>{{ $p->nama_barang }}</b><br>
        Total Harga : Rp {{ number_format($p->total_harga) }}<br>
        Ukuran : {{ $p->ukuran }}<br>
        Ongkir : Rp 5.500
    </div>

    <div class="transaksi-right">
        <div class="total-bayar">Telah Dibayar</div>
        <span class="nominal">
            Rp {{ number_format($p->total_harga + 5500) }}
        </span>

        <a href="/petugas/pengiriman" class="btn-proses">
            Proses Pesanan
        </a>
    </div>

</div>

@empty

<p>Tidak ada transaksi</p>

@endforelse

</div>

@endsection