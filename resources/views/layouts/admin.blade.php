<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial;
}

/* FIX ROOT */
body{
display:flex;
background:#f4f4f4;
min-height:100vh;
overflow-x:hidden;
}

/* SIDEBAR */
.sidebar{
width:220px;
background:#3b5b92;
color:white;
flex-shrink:0;
}

.sidebar-title{
background:#1E3A8A;
padding:15px;
text-align:center;
font-weight:bold;
}

.sidebar a{
display:block;
padding:12px 20px;
color:white;
text-decoration:none;
font-size:14px;
}

.sidebar a:hover{
background:#274472;
}

.sidebar a.active{
    background:#1E3A8A; /* biru tua */
}

/* MAIN */
.main{
flex:1;
display:flex;
flex-direction:column;
position:relative;
z-index:2; /* pastikan di atas apapun */
}

/* HEADER */
.header{
height:70px;
background:white;
display:flex;
justify-content:space-between;
align-items:center;
padding:0 20px;
border-bottom:1px solid #ccc;
z-index:2;
}

.logo{
height:55px;
}

/* TITLE */
.page-title{
    background:#1E3A8A;
    color:white;
    padding:12px;
    text-align:center;
    font-weight:bold;
    letter-spacing:1px;
}

/* CONTENT */
.content{
padding:20px;
position:relative;
z-index:2;
}

/* 🔥 MATIIN SEMUA OVERLAY LIAR */
body::before,
body::after{
display:none !important;
content:none !important;
}

/* HAPUS SEMUA DIV FULL SCREEN YANG NUTUP */
div[style*="position: absolute"],
div[style*="position: fixed"]{
pointer-events:none !important;
}

/* BALIKIN INTERAKSI KE AREA UTAMA */
.sidebar, .main, .content, .header{
pointer-events:auto !important;
}

/* PAKSA HAPUS SEMUA OVERLAY */
body * {
    pointer-events: auto !important;
}

/* KECUALI OVERLAY LIAR */
div[style*="position: absolute"],
div[style*="position: fixed"] {
    pointer-events: none !important;
}
</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
<div class="sidebar-title">Menu Admin</div>

<a href="/admin" class="{{ request()->is('admin') ? 'active' : '' }}">Dashboard</a>

<a href="/admin/produk" class="{{ request()->is('admin/produk*') ? 'active' : '' }}">Kelola Produk</a>

<a href="/admin/user" class="{{ request()->is('admin/user*') ? 'active' : '' }}">Data User</a>

<a href="/admin/petugas" class="{{ request()->is('admin/petugas*') ? 'active' : '' }}">Data Petugas</a>

<a href="/admin/transaksi" class="{{ request()->is('admin/transaksi*') ? 'active' : '' }}">Data Transaksi</a>

<a href="/admin/pesanan" class="{{ request()->is('admin/pesanan*') ? 'active' : '' }}">Data Pesanan</a>

<a href="/admin/pengiriman" class="{{ request()->is('admin/pengiriman*') ? 'active' : '' }}">Data Pengiriman</a>
</div>

<!-- MAIN -->
<div class="main">

<div class="header">
<img src="{{ asset('images/outfitmart.png') }}" class="logo">
<div>Admin OutfitMart</div>
</div>

<div class="page-title">
    @yield('title')
</div>

<div class="content">
@yield('content')
</div>

</div>

</body>
</html>