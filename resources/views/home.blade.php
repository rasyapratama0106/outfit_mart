@extends('layouts.app')

@section('title','Home - OutfitMart')

@section('content')

<script src="https://unpkg.com/lucide@latest"></script>

<style>
body{
    margin:0;
    font-family:'Crimson Text', serif;
    background:#f5f5f5;
}

.container{
    max-width:1200px;
    margin:auto;
    padding:20px 40px;
}

.card-link{
    text-decoration:none;
    color:inherit;
    display:block;
}

.navbar{
    display:flex;
    align-items:center;
    justify-content:space-between;
}

.nav-left{
    display:flex;
    align-items:center;
    gap:20px;
}

.logo{
    height:60px;
}

.search-box{
    background:#ddd;
    border-radius:40px;
    padding:10px 20px;
    width:400px;
    border:none;
}

.nav-right{
    display:flex;
    align-items:center;
    gap:25px;
}

.nav-right a{
    text-decoration:none;
    color:black;
}

.nav-right i{
    width:24px;
    height:24px;
    cursor:pointer;
    transition:0.2s;
}

.nav-right i:hover{
    transform:scale(1.15);
    color:#1E3A8A;
}

.user-menu{
    display:flex;
    align-items:center;
    gap:8px;
}

.logout-btn{
    background:none;
    border:none;
    font-weight:bold;
    cursor:pointer;
}

.hero{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:40px;
}

.hero-text h1{
    font-size:55px;
}

.hero-text span{
    color:#D4AF37;
}

.hero-image img{
    width:350px;
}

.koleksi{
    background:#1E3A8A;
    padding:20px;
    text-align:center;
    color:#D4AF37;
    margin-top:40px;
    font-size:30px;
}

.products{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:18px;
    margin-top:30px;
}

.card{
    background:white;
    border-radius:10px;
    padding:12px;
    text-align:center;
    box-shadow:0 2px 6px rgba(0,0,0,0.08);
    transition:0.2s;
}

.card:hover{
    transform:translateY(-3px);
}

.card img{
    width:100%;
    height:180px;
    object-fit:contain;
}
</style>

<div class="container">

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="nav-left">
            <img src="{{ asset('images/outfitmart.png') }}" class="logo">

            <form action="{{ route('search') }}" method="GET">
                <input type="text" name="q" class="search-box" placeholder="cari di sini">
            </form>
        </div>

        <div class="nav-right">

            <!-- FAVORIT -->
            <a href="{{ route('favorit') }}">
                <i data-lucide="heart"></i>
            </a>

            <!-- CHAT -->
            <a href="{{ route('chat.user') }}">
                <i data-lucide="message-circle"></i>
            </a>

            <!-- PESANAN -->
            <a href="{{ url('/pesanan') }}">
                <i data-lucide="package"></i>
            </a>

            <!-- KERANJANG -->
            <a href="{{ route('keranjang') }}">
                <i data-lucide="shopping-cart"></i>
            </a>

            <!-- USER -->
            <div class="user-menu">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">LOGOUT</button>
                </form>

                <a href="{{ route('pengaturan') }}">
                    @if(Auth::user()->photo)
                        <img src="{{ asset('profile/'.Auth::user()->photo) }}" 
                             style="width:35px;height:35px;border-radius:50%;">
                    @else
                        <i data-lucide="user"></i>
                    @endif
                </a>
            </div>

        </div>
    </div>

    <!-- HERO -->
    <div class="hero">
        <div class="hero-text">
            <h1>HALO 👋<br>Selamat Datang di <span>OutfitMart</span></h1>
            <p>Temukan Outfit Terbaik Untuk Gaya Kamu Hari Ini.</p>
        </div>

        <div class="hero-image">
            <img src="{{ asset('images/model1.png') }}">
        </div>
    </div>

</div>

<div class="koleksi">Rekomendasi</div>

<div class="container">
    <div class="products">

        @foreach($products as $product)
        <div style="position:relative;">

            <!-- ❤️ FAVORIT ICON -->
            @auth
            <form action="{{ route('favorite.toggle', $product->id) }}" method="POST"
                  style="position:absolute; top:10px; right:10px; z-index:10;">
                @csrf

                @php
                    $liked = \App\Models\Favorite::where('user_id', auth()->id())
                                ->where('product_id', $product->id)
                                ->exists();
                @endphp

                <button style="background:none;border:none;cursor:pointer;">
                    @if($liked)
                        <i data-lucide="heart" style="color:red; fill:red;"></i>
                    @else
                        <i data-lucide="heart"></i>
                    @endif
                </button>
            </form>
            @endauth

            <!-- CARD -->
            <a href="{{ route('product.detail', $product->id) }}" class="card-link">
                <div class="card">
                    <img src="{{ asset('images/'.$product->image) }}">
                    <h4>{{ $product->name }}</h4>
                    <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </a>

        </div>
        @endforeach

    </div>
</div>

<script>
lucide.createIcons();
</script>

@endsection