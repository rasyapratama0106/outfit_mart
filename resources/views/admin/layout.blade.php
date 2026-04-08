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

body{
display:flex;
background:#f4f4f4;
height:100vh;
}

.sidebar{
width:220px;
background:#3b5b92;
color:white;
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

.main{
flex:1;
display:flex;
flex-direction:column;
}

.header{
height:70px;
background:white;
display:flex;
justify-content:space-between;
align-items:center;
padding:0 20px;
border-bottom:1px solid #ccc;
}

.logo{
height:55px;
}

.title{
background:black;
color:white;
padding:10px;
text-align:center;
font-weight:bold;
}

.content{
padding:20px;
}
</style>

</head>

<body>

<div class="sidebar">
<div class="sidebar-title">Menu Admin</div>

<a href="/admin">Dashboard</a>
<a href="/admin/produk">Kelola Produk</a>
<a href="/admin/user">Data User</a>
<a href="/admin/petugas">Data Petugas</a>
<a href="/admin/transaksi">Data Transaksi</a>
<a href="/admin/pesanan">Data Pesanan</a>
<a href="/admin/pengiriman">Data Pengiriman</a>
</div>

<div class="main">

<div class="header">
<img src="{{ asset('images/outfitmart.png') }}" class="logo">
<div>Admin OutfitMart</div>
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