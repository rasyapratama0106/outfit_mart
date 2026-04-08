@extends('layouts.admin')

@section('title', 'Data Pesanan')

@section('content')

<style>

.pesanan-container{
    background:#d9d9d9;
    padding:20px;
    border-radius:10px;
}

/* CARD */
.pesanan-card{
    display:flex;
    justify-content:space-between;
    gap:30px;
    background:white;
    padding:20px;
    border-radius:12px;
    margin-bottom:15px;
    align-items:flex-start;
}

/* KIRI */
.pesanan-left{
    display:flex;
    gap:20px;
    flex:2;
}

.pesanan-img{
    width:140px;
    height:140px;
    object-fit:cover;
    border-radius:10px;
}

.pesanan-info{
    font-size:14px;
    line-height:1.7;
}

.pesanan-title{
    font-weight:bold;
    font-size:16px;
    margin-bottom:8px;
}

/* KANAN (BUKTI) */
.pesanan-right{
    flex:1;
    text-align:center;
}

.bukti-title{
    font-weight:bold;
    margin-bottom:10px;
}

.bukti-img{
    width:140px;
    height:140px;
    object-fit:cover;
    border-radius:10px;
    border:1px solid #ddd;
}

/* RESPONSIVE */
@media (max-width:768px){
    .pesanan-card{
        flex-direction:column;
    }

    .pesanan-left{
        flex-direction:column;
        align-items:center;
    }

    .pesanan-right{
        text-align:left;
        margin-top:15px;
    }
}

</style>

<div class="pesanan-container">

@foreach($pesanans as $p)

<div class="pesanan-card">

    <!-- KIRI -->
    <div class="pesanan-left">

        <img src="{{ asset('images/'.$p->image) }}" class="pesanan-img">

        <div class="pesanan-info">

            <div class="pesanan-title">
                {{ $p->nama_barang }}
            </div>

            Nama Barang : {{ $p->nama_barang }} <br>
            Total Harga : Rp {{ number_format($p->total_harga) }} <br>
            Ukuran : {{ $p->ukuran }} <br>
            Status : {{ $p->status }} <br>
            Nama Pembeli : {{ $p->nama_pembeli }}

        </div>

    </div>

    <!-- KANAN -->
    <div class="pesanan-right">

        <div class="bukti-title">Bukti</div>

        @if($p->bukti)

            <img src="{{ asset('bukti/'.$p->bukti) }}" 
                 class="bukti-img"
                 onerror="this.onerror=null;this.src='{{ asset('images/'.$p->bukti) }}';">

        @else
            <span>Belum ada</span>
        @endif

    </div>

</div>

@endforeach

</div>

@endsection