<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>

<!-- 🔥 WAJIB: CSRF TOKEN -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial;
}

body{
display:flex;
background:#f4f4f4;
}

/* SIDEBAR */
.sidebar{
width:220px;
background:#3b5b92;
color:white;
min-height:100vh;
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
}

.sidebar a:hover{
background:#274472;
}

.active{
background:#1E3A8A;
}

/* MAIN */
.main{
flex:1;
display:flex;
flex-direction:column;
}

/* HEADER */
.header{
height:70px;
background:white;
display:flex;
justify-content:space-between;
align-items:center;
padding:0 30px;
border-bottom:1px solid #ccc;
}

.logo{
height:55px;
}

/* TITLE */
.title{
background:black;
color:white;
padding:10px;
text-align:center;
font-weight:bold;
}

/* CONTENT */
.content{
padding:20px;
}
</style>

</head>

<body>

<div class="sidebar">
<div class="sidebar-title">Menu Petugas</div>

<a href="/petugas/dashboard" class="{{ request()->is('petugas/dashboard') ? 'active' : '' }}">Dashboard</a>

<a href="/petugas/transaksi" class="{{ request()->is('petugas/transaksi') ? 'active' : '' }}">Data Transaksi</a>
<a href="/petugas/pesanan" class="{{ request()->is('petugas/pesanan') ? 'active' : '' }}">Data Pesanan</a>
<a href="/petugas/pengiriman" class="{{ request()->is('petugas/pengiriman') ? 'active' : '' }}">Data Pengiriman</a>
</div>

<div class="main">

<div class="header">

    <div style="display:flex; align-items:center; gap:15px;">
        <a href="/petugas/pesanan" class="back-btn">←</a>
        <img src="{{ asset('images/outfitmart.png') }}" class="logo">
    </div>

    <div>Petugas OutfitMart</div>

</div>

<div class="title">
@yield('title')
</div>

<div class="content">
@yield('content')
</div>

</div>

</body>
</html>