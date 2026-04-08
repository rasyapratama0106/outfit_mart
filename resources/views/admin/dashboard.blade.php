@extends('layouts.admin')

@section('title', 'Menu Admin')

@section('content')

<script src="https://unpkg.com/lucide@latest"></script>

<style>

.grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
    max-width:900px;
    margin:auto;
}

/* CARD */
.card{
    height:130px;
    border-radius:10px;
    padding:15px;

    display:flex;
    flex-direction:column;
    justify-content:space-between;

    cursor:pointer;
    transition:0.2s;

    box-shadow:0 3px 10px rgba(0,0,0,0.08);
    border:1px solid rgba(0,0,0,0.05);

    color:black;
}

/* HOVER */
.card:hover{
    transform:scale(1.05);
    filter:brightness(0.95);
}

/* LINK */
.grid a{
    text-decoration:none;
    color:inherit;
}

/* TITLE */
.title{
    font-size:14px;
    font-weight:bold;
    color:black;
}

/* ICON */
.icon{
    display:flex;
    justify-content:flex-end;
}

.icon i{
    width:30px;
    height:30px;
    stroke-width:2;
    color:black;
    stroke:black;
}

/* 🔥 WARNA SOFT PER CARD */
.produk{ background:#FFE5E0; }
.user{ background:#E6F7F1; }
.petugas{ background:#E6F0FF; }
.transaksi{ background:#E8FFF5; }
.pesanan{ background:#FFF6E5; }
.pengiriman{ background:#F3E8FF; }

</style>

<div class="grid">

<a href="{{ route('admin.product') }}">
<div class="card produk">
<div class="title">KELOLA PRODUK</div>
<div class="icon"><i data-lucide="package"></i></div>
</div>
</a>

<a href="{{ route('admin.user') }}">
<div class="card user">
<div class="title">DATA USER</div>
<div class="icon"><i data-lucide="user"></i></div>
</div>
</a>

<a href="{{ route('admin.petugas') }}">
<div class="card petugas">
<div class="title">DATA PETUGAS</div>
<div class="icon"><i data-lucide="users"></i></div>
</div>
</a>

<a href="{{ route('admin.transaksi') }}">
<div class="card transaksi">
<div class="title">DATA TRANSAKSI</div>
<div class="icon"><i data-lucide="credit-card"></i></div>
</div>
</a>

<a href="{{ route('admin.pesanan') }}">
<div class="card pesanan">
<div class="title">DATA PESANAN</div>
<div class="icon"><i data-lucide="shopping-cart"></i></div>
</div>
</a>

<a href="{{ route('admin.pengiriman') }}">
<div class="card pengiriman">
<div class="title">DATA PENGIRIMAN</div>
<div class="icon"><i data-lucide="truck"></i></div>
</div>
</a>

</div>

<script>
lucide.createIcons();
</script>

@endsection