@extends('layouts.app')

@section('title','Pesanan Saya')

@section('content')

<script src="https://unpkg.com/lucide@latest"></script>

<style>

/* BACKGROUND */
body{
    background:#f5f7fb;
}

/* CONTAINER */
.container {
    max-width: 1100px;
    margin: auto;
    padding: 30px 20px;
}

/* HEADER */
.header-bar {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 30px;
}

.logo {
    width: 110px;
    height: 110px;
    object-fit: contain;
}

.header-bar h2 {
    font-size: 22px;
    color: #111;
    font-weight: 600;
}

/* CARD */
.card {
    display: flex;
    gap: 20px;
    background: #fff;
    border-radius: 16px;
    padding: 18px;
    margin-bottom: 18px;
    align-items: center;
    position: relative;

    border:1px solid #eee;
    box-shadow:0 4px 12px rgba(0,0,0,0.04);
    transition:0.25s;
}

.card:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 20px rgba(0,0,0,0.06);
}

/* IMAGE */
.card img {
    width: 100px;
    height: 100px;
    border-radius: 12px;
    object-fit: cover;
}

/* DETAIL */
.detail {
    flex: 1;
}

.detail h3 {
    margin: 0 0 5px 0;
    color: #111;
    font-size:16px;
    font-weight:600;
}

.price{
    font-weight:600;
    color:#1e3a8a;
    margin-bottom:4px;
}

.meta{
    font-size:13px;
    color:#666;
}

/* RIGHT */
.right {
    text-align: right;
}

/* BADGE */
.badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11px;
    color: white;
    display:inline-block;
    margin-bottom:8px;
}

.diproses { background: #f59e0b; }
.siap { background: #7c3aed; }
.dikirim { background: #2563eb; }
.menuju { background: #1d4ed8; }
.sampai { background: #0d9488; }

/* BUTTON */
.btn {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition:0.2s;
}

/* PRIMARY */
.btn-detail {
    background: #1e3a8a;
    color: white;
}

.btn-detail:hover{
    background:#162d6b;
}

/* SUCCESS */
.btn-selesai {
    background: #16a34a;
    color: white;
}

.btn-selesai:hover{
    background:#15803d;
}

/* SELESAI TEXT */
.selesai-text {
    color: #16a34a;
    font-weight: 600;
    font-size:13px;
    margin-bottom: 6px;
}

/* ADDRESS */
.address{
    font-size:12px;
    color:#777;
}

/* RESPONSIVE */
@media (max-width:768px){
    .card{
        flex-direction:column;
        align-items:flex-start;
    }

    .right{
        text-align:left;
        margin-top:10px;
    }
}

</style>

<div class="container">

    <!-- HEADER -->
    <div class="header-bar">
        <img src="{{ asset('images/outfitmart.png') }}" class="logo">
        <h2>Pesanan Anda</h2>
    </div>

    @foreach($pesanans as $item)

    <div class="card">

        <!-- IMAGE -->
        <img 
            src="{{ asset('images/'.$item->image) }}" 
            onerror="this.src='{{ asset('images/boxy.jpg') }}'">

        <!-- DETAIL -->
        <div class="detail">

            @if($item->status == 'selesai')
                <div class="selesai-text">
                    ✔ Pesanan Selesai
                </div>
            @endif

            <h3>{{ $item->nama_barang }}</h3>

            <div class="price">
                Rp {{ number_format($item->total_harga,0,',','.') }}
            </div>

            <div class="meta">
                Ukuran: {{ $item->ukuran }} • 
                {{ $item->created_at->format('d M Y') }}
            </div>

            <div class="address">
                📍 {{ $item->alamat }}
            </div>

        </div>

        <!-- RIGHT -->
        <div class="right">

            @if(!in_array($item->status, ['sampai','selesai']))

                <div class="badge {{ $item->status }}">
                    {{ strtoupper($item->status) }}
                </div>

                <br>

                <a href="{{ route('detail.pesanan', $item->id) }}" class="btn btn-detail">
                    Detail
                </a>

            @elseif($item->status == 'sampai')

                <form action="/pesanan/selesai/{{ $item->id }}" method="POST">
                    @csrf
                    <button class="btn btn-selesai">
                        ✔ Konfirmasi Selesai
                    </button>
                </form>

                <br>

                <a href="{{ route('detail.pesanan', $item->id) }}" class="btn btn-detail">
                    Detail
                </a>

            @elseif($item->status == 'selesai')

                <a href="{{ route('detail.pesanan', $item->id) }}" class="btn btn-detail">
                    Detail
                </a>

            @endif

        </div>

    </div>

    @endforeach

</div>

<script>
lucide.createIcons();
</script>

@endsection