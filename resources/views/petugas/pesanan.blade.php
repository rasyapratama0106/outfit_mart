@extends('layouts.petugas')

@section('title','Data Pesanan')

@section('content')

@php
use App\Models\Pesanan;
$pesanans = Pesanan::all();
@endphp

<style>

/* BOX UTAMA (SAMA PERSIS KAYAK TRANSAKSI) */
.pesanan-box{
    background:#d9d9d9;
    padding:20px;
    border-radius:10px;
}

/* ITEM */
.pesanan-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;
    background:white;
    padding:15px 20px;
    border-radius:10px;
    margin-bottom:15px;
}

/* GAMBAR */
.pesanan-img{
    width:80px;
    height:80px;
    object-fit:cover;
    border-radius:10px;
}

/* INFO */
.pesanan-info{
    flex:1;
    font-size:14px;
}

.pesanan-info b{
    font-size:15px;
}

/* STATUS */
.status{
    display:inline-block;
    margin-top:5px;
    padding:5px 12px;
    border-radius:20px;
    background:#1E3A8A;
    color:white;
    font-size:12px;
}

/* RIGHT */
.pesanan-right{
    text-align:right;
    min-width:160px;
}

/* BUTTON */
.btn{
    display:inline-block;
    margin-top:8px;
    padding:7px 16px;
    border:none;
    border-radius:20px;
    font-size:13px;
    text-decoration:none;
}

/* DETAIL */
.btn-detail{
    background:#ddd;
    color:black;
}

/* PROSES */
.btn-proses{
    background:#1E3A8A;
    color:white;
}

.btn-proses:hover{
    background:#16306f;
}

</style>

<div class="pesanan-box">

<b>Data Pesanan</b>

@forelse($pesanans as $p)

<div class="pesanan-item">

    {{-- GAMBAR --}}
    @if($p->image)
        <img src="{{ asset('images/'.$p->image) }}" 
             class="pesanan-img"
             onerror="this.src='https://via.placeholder.com/80'">
    @else
        <img src="https://via.placeholder.com/80" class="pesanan-img">
    @endif

    {{-- INFO --}}
    <div class="pesanan-info">
        <b>{{ $p->nama_barang }}</b><br>
        Nama Pembeli : {{ $p->nama_pembeli }}<br>
        Total : Rp {{ number_format($p->total_harga) }}<br>
        Ukuran : {{ $p->ukuran }}<br>

        <span class="status">
            {{ $p->status }}
        </span>
    </div>

    {{-- KANAN --}}
    <div class="pesanan-right">

        <a href="/petugas/pesanan/{{ $p->id }}" class="btn btn-detail">
            Detail
        </a>

        <br>

        <a href="/petugas/pengiriman" class="btn btn-proses">
            Proses
        </a>

    </div>

</div>

@empty

<p>Tidak ada pesanan</p>

@endforelse

</div>

@endsection