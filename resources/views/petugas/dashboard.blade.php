@extends('layouts.petugas')

@section('title', 'Dashboard Petugas')

@section('content')

<script src="https://unpkg.com/lucide@latest"></script>

<style>

.wrapper{
max-width:1000px;
margin:auto;
}

/* GRID */
.menu-grid{
display:grid;
grid-template-columns:repeat(3, 1fr);
gap:20px;
margin-top:20px;
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

/* TITLE */
.judul{
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

/* 🔥 WARNA SOFT (SAMAKAN ADMIN) */
.pengiriman{ background:#F3E8FF; }
.transaksi{ background:#E8FFF5; }
.pesanan{ background:#FFF6E5; }
.chat{ background:#E6F0FF; }

</style>

<div class="wrapper">

<h3>MENU PETUGAS</h3>

<div class="menu-grid">

<a href="/petugas/pengiriman" style="text-decoration:none;">
<div class="card pengiriman">
<div class="judul">DATA PENGIRIMAN</div>
<div class="icon"><i data-lucide="truck"></i></div>
</div>
</a>

<a href="/petugas/transaksi" style="text-decoration:none;">
<div class="card transaksi">
<div class="judul">DATA TRANSAKSI</div>
<div class="icon"><i data-lucide="refresh-ccw"></i></div>
</div>
</a>

<a href="/petugas/pesanan" style="text-decoration:none;">
<div class="card pesanan">
<div class="judul">DATA PESANAN</div>
<div class="icon"><i data-lucide="shopping-bag"></i></div>
</div>
</a>

<a href="/petugas/chat" style="text-decoration:none;">
<div class="card chat">
<div class="judul">CHAT USER</div>
<div class="icon"><i data-lucide="message-circle"></i></div>
</div>
</a>

</div>

</div>

<script>
lucide.createIcons();
</script>

@endsection