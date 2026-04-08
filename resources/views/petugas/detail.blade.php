@extends('layouts.petugas')

@section('title','Detail Pesanan')

@section('content')

<style>
/* RESET AREA */
.content{
    padding:0 !important;
}

/* WRAPPER FULL */
.full-page{
    background:#0f3c82;
    min-height:100vh;
    padding:30px;
}

/* HEADER */
.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.back{
    background:white;
    padding:8px 15px;
    border-radius:10px;
    text-decoration:none;
    font-weight:bold;
    color:black;
}

.title-box{
    background:#dcdcdc;
    padding:10px 25px;
    border-radius:10px;
    font-weight:bold;
}

.right-text{
    color:white;
}

/* STATUS */
.status{
    text-align:center;
    color:white;
    font-weight:bold;
    margin-bottom:30px;
    letter-spacing:1px;
}

/* CONTENT */
.flex-box{
    display:flex;
    gap:40px;
    align-items:center;
    max-width:900px;
    margin:auto;
}

/* IMAGE */
.flex-box img{
    width:230px;
    border-radius:15px;
}

/* DETAIL */
.detail{
    color:white;
}

.detail h2{
    margin-bottom:15px;
}

.detail p{
    margin:4px 0;
}

/* BUTTON */
.btn{
    margin-top:15px;
    background:black;
    color:white;
    border:none;
    padding:8px 25px;
    border-radius:20px;
    cursor:pointer;
}
</style>

<div class="full-page">

    <!-- STATUS -->
    <div class="status">
        @if($pesanan->status == 'diproses')
            PESANAN SEDANG DI PROSES
        @elseif($pesanan->status == 'siap')
            PESANAN SIAP DIKIRIM
        @elseif($pesanan->status == 'dikirim')
            PESANAN SEDANG DIKIRIM
        @elseif($pesanan->status == 'menuju')
            PESANAN MENUJU LOKASI
        @elseif($pesanan->status == 'sampai')
            PESANAN SUDAH SAMPAI
        @endif
    </div>

    <!-- CONTENT -->
    <div class="flex-box">

        <!-- GAMBAR -->
        <img src="{{ asset('images/'.$pesanan->image) }}">

        <!-- DETAIL -->
        <div class="detail">

            <h2>Pesanan {{ $pesanan->nama_pembeli }}</h2>

            <p>Nama Barang : {{ $pesanan->nama_barang }}</p>
            <p>Total Harga : Rp {{ number_format($pesanan->total_harga,0,',','.') }}</p>
            <p>Ukuran : {{ $pesanan->ukuran }}</p>
            <p>Diskon : -</p>
            <p>Ongkir : Rp 5.500</p>

            <p>
                Total :
                Rp {{ number_format($pesanan->total_harga + 5500,0,',','.') }}
            </p>

            <!-- BUTTON -->
            
<form method="POST" action="{{ route('pengiriman.update', $pesanan->id) }}">
    @csrf

    @if($pesanan->status == 'diproses')
        <input type="hidden" name="status" value="siap">
        <button class="btn">SIAPKAN</button>

    @elseif($pesanan->status == 'siap')
        <input type="hidden" name="status" value="dikirim">
        <button class="btn">KIRIM</button>

    @elseif($pesanan->status == 'dikirim')
        <input type="hidden" name="status" value="menuju">
        <button class="btn">MENUJU</button>

    @elseif($pesanan->status == 'menuju')
        <input type="hidden" name="status" value="sampai">
        <button class="btn">SELESAI</button>

    @else
        <button class="btn" disabled>SELESAI</button>
    @endif

</form>
        </div>

    </div>

</div>

@endsection