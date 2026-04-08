@extends('layouts.admin')

@section('title', 'Data Transaksi')

@section('content')

<style>

.transaksi-container{
background:#d9d9d9;
padding:20px;
border-radius:10px;
}

.section-title{
font-weight:bold;
margin-bottom:15px;
}

.transaksi-card{
display:flex;
justify-content:space-between;
align-items:center;
background:white;
padding:15px;
border-radius:10px;
margin-bottom:15px;
}

.transaksi-left{
display:flex;
gap:15px;
}

.transaksi-img{
width:100px;
height:100px;
object-fit:cover;
border-radius:10px;
}

.transaksi-info{
font-size:14px;
}

.transaksi-right{
text-align:right;
}

.status-bayar{
font-weight:bold;
margin-bottom:10px;
}

.metode{
font-size:13px;
margin-bottom:10px;
}

.btn{
background:#eee;
border:none;
padding:8px 15px;
border-radius:20px;
cursor:pointer;
}

.btn:hover{
background:#ccc;
}

</style>

<div class="transaksi-container">

<div class="section-title">
Transaksi Belum Dibaca
</div>

@foreach($pesanans as $p)

<div class="transaksi-card">

<div class="transaksi-left">

<img src="{{ asset('images/'.$p->image) }}" class="transaksi-img">

<div class="transaksi-info">
Nama Barang : {{ $p->nama_barang }} <br>
Total Harga : Rp {{ number_format($p->total_harga) }} <br>
Ukuran : {{ $p->ukuran }} <br>
Alamat : {{ $p->alamat }} <br>
</div>

</div>

<div class="transaksi-right">

<div class="status-bayar">
Telah Dibayar Rp {{ number_format($p->total_harga) }}
</div>

<div class="metode">
Metode : {{ strtoupper($p->metode) }}
</div>

<a href="{{ route('admin.pesanan') }}" class="btn">
    Proses Pesanan
</a>

</div>

</div>

@endforeach


@endsection