@extends('layouts.app')

@section('title','Detail Pesanan')

@section('content')

<style>

/* BACKGROUND */
body{
    background:#f5f7fb;
}

/* CONTAINER */
.container {
    max-width: 1000px;
    margin: 40px auto;
    padding: 20px;
}

/* BACK BUTTON */
.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    background: #1e3a8a;
    color: white;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 25px;
    transition: 0.2s;
}

.back-btn:hover {
    background: #162d6b;
    transform: translateX(-3px);
}

/* MAIN BOX */
.detail-box {
    position: relative;
    background: white;
    border-radius: 20px;
    padding: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 30px;

    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

/* LOGO BESAR (WATERMARK STYLE) */
.logo-bg{
    position:absolute;
    right:20px;
    top:20px;
    width:180px;
    opacity:0.08;
    pointer-events:none;
}

/* LEFT */
.detail-text {
    flex:1;
}

.detail-text h2 {
    font-size: 22px;
    margin-bottom: 20px;
    color:#111;
}

/* ITEM ROW */
.item{
    margin-bottom:10px;
    font-size:14px;
    color:#444;
}

.label{
    color:#888;
}

/* STATUS */
.status{
    display:inline-block;
    padding:5px 12px;
    border-radius:20px;
    background:#1e3a8a;
    color:white;
    font-size:12px;
    margin-top:5px;
}

/* IMAGE */
.detail-img img {
    width: 220px;
    height: 220px;
    object-fit: cover;
    border-radius: 16px;
    border:1px solid #eee;
    transition:0.3s;
}

.detail-img img:hover{
    transform:scale(1.05);
}

/* RESPONSIVE */
@media (max-width:768px){
    .detail-box{
        flex-direction:column;
        text-align:center;
    }

    .logo-bg{
        width:120px;
        top:10px;
        right:10px;
    }
}

</style>

<div class="container">

    <a href="/pesanan" class="back-btn">
        ← Kembali
    </a>

    <div class="detail-box">

        <!-- LOGO WATERMARK -->
        <img src="{{ asset('images/outfitmart.png') }}" class="logo-bg">

        <!-- KIRI -->
        <div class="detail-text">
            <h2>Detail Pesanan</h2>

            <div class="item">
                <span class="label">Nama Barang :</span><br>
                <b>{{ $pesanan->nama_barang }}</b>
            </div>

            <div class="item">
                <span class="label">Total Harga :</span><br>
                <b style="color:#1e3a8a;">
                    Rp {{ number_format($pesanan->total_harga,0,',','.') }}
                </b>
            </div>

            <div class="item">
                <span class="label">Ukuran :</span><br>
                {{ $pesanan->ukuran }}
            </div>

            <div class="item">
                <span class="label">Alamat :</span><br>
                {{ $pesanan->alamat }}
            </div>

            <div class="item">
                <span class="label">Status :</span><br>
                <span class="status">
                    {{ strtoupper($pesanan->status) }}
                </span>
            </div>

        </div>

        <!-- KANAN -->
        <div class="detail-img">
            <img 
                src="{{ asset('images/'.$pesanan->image) }}" 
                onerror="this.src='{{ asset('images/boxy.jpg') }}'">
        </div>

    </div>

</div>

@endsection