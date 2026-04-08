@extends('layouts.app')

@section('title','Favorit')

@section('content')

<script src="https://unpkg.com/lucide@latest"></script>

<style>

/* BACKGROUND */
body{
    background:#f5f7fb;
}

/* CONTAINER */
.container{
    max-width:1100px;
    margin:auto;
    padding:30px 20px;
}

/* TITLE */
.title{
    font-size:22px;
    font-weight:600;
    margin-bottom:25px;
    color:#1e3a8a;
}

/* GRID */
.products{
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(220px,1fr));
    gap:20px;
}

/* CARD */
.card{
    position:relative;
    background:#fff;
    padding:15px;
    border-radius:16px;
    text-align:center;

    border:1px solid #eee;
    box-shadow:0 4px 12px rgba(0,0,0,0.05);
    transition:0.25s;
}

.card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

/* IMAGE */
.card img{
    width:100%;
    height:200px;
    object-fit:cover;
    border-radius:12px;
    margin-bottom:10px;
}

/* NAME */
.card h4{
    font-size:15px;
    color:#111;
    margin-bottom:5px;
}

/* PRICE */
.price{
    color:#1e3a8a;
    font-weight:600;
    margin-bottom:10px;
}

/* BUTTON DETAIL */
.btn-detail{
    display:inline-block;
    padding:6px 14px;
    border-radius:20px;
    font-size:12px;
    background:#1e3a8a;
    color:white;
    text-decoration:none;
    transition:0.2s;
}

.btn-detail:hover{
    background:#162d6b;
}

/* LOVE BUTTON */
.love-btn{
    position:absolute;
    top:10px;
    right:10px;
    background:white;
    border:none;
    border-radius:50%;
    width:35px;
    height:35px;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;

    box-shadow:0 2px 6px rgba(0,0,0,0.1);
}

.love-btn:hover{
    transform:scale(1.1);
}

/* EMPTY */
.empty{
    text-align:center;
    margin-top:60px;
    font-size:16px;
    color:#777;
}

</style>

<div class="container">

    <div class="title">Produk Favorit</div>

    @if($favorites->count() == 0)
        <div class="empty">
            Belum ada produk favorit 😢
        </div>
    @else

    <div class="products">

        @foreach($favorites as $fav)

            @php
                $product = \App\Models\Product::find($fav->product_id);
            @endphp

            @if($product)
            <div class="card">

                <!-- ❤️ REMOVE FAVORIT -->
                <form action="{{ route('favorite.toggle', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="love-btn">
                        <i data-lucide="heart" style="color:red; fill:red;"></i>
                    </button>
                </form>

                <img src="{{ asset('images/'.$product->image) }}">

                <h4>{{ $product->name }}</h4>

                <div class="price">
                    Rp {{ number_format($product->price,0,',','.') }}
                </div>

                <a href="{{ route('product.detail', $product->id) }}" class="btn-detail">
                    Lihat Detail
                </a>

            </div>
            @endif

        @endforeach

    </div>

    @endif

</div>

<script>
lucide.createIcons();
</script>

@endsection