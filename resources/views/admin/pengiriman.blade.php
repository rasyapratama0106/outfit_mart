@extends('layouts.admin')

@section('title', 'Data Pengiriman')

@section('content')

<style>

.pengiriman-container{
background:#d9d9d9;
padding:20px;
border-radius:10px;
}

.pengiriman-card{
display:flex;
justify-content:space-between;
align-items:center;
background:white;
padding:15px;
border-radius:10px;
margin-bottom:15px;
}

.pengiriman-left{
display:flex;
gap:15px;
align-items:center;
}

.pengiriman-img{
width:80px;
height:80px;
border-radius:10px;
object-fit:cover;
}

.pengiriman-info{
font-size:14px;
}

.pengiriman-title{
font-weight:bold;
margin-bottom:5px;
}

.pengiriman-right{
text-align:right;
}

.status{
font-weight:bold;
margin-bottom:8px;
}

.proses{ color:orange; }
.kirim{ color:blue; }
.selesai{ color:green; }

.btn{
background:#2e5aac;
color:white;
border:none;
padding:6px 15px;
border-radius:20px;
cursor:pointer;
}

</style>

<div class="pengiriman-container">

@foreach($pesanans as $p)

<div class="pengiriman-card">

    <div class="pengiriman-left">

        <!-- GAMBAR PRODUK -->
        @if($p->image)
            <img src="{{ asset('images/'.$p->image) }}" class="pengiriman-img">
        @endif

        <div class="pengiriman-info">
            <div class="pengiriman-title">{{ $p->nama_barang }}</div>

            Penerima: {{ $p->nama_pembeli }} <br>
            Alamat: {{ $p->alamat ?? '-' }} <br>
            Metode: {{ $p->metode ?? '-' }}
        </div>

    </div>

    <div class="pengiriman-right">

        <!-- STATUS -->
        <div class="status 
            @if($p->status == 'diproses') proses 
            @elseif($p->status == 'dikirim') kirim 
            @elseif($p->status == 'selesai') selesai 
            @endif
        ">
            {{ $p->status }}
        </div>

        <!-- BUTTON UPDATE -->
        <form method="POST" action="{{ url('/admin/pengiriman/update/'.$p->id) }}">
            @csrf

            @if($p->status == 'diproses')
                <input type="hidden" name="status" value="dikirim">
                <button class="btn">Kirim</button>

            @elseif($p->status == 'dikirim')
                <input type="hidden" name="status" value="selesai">
                <button class="btn">Selesai</button>
            @endif

        </form>

    </div>

</div>

@endforeach

</div>

@endsection