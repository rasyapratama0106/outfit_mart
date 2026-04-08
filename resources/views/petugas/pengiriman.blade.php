@extends('layouts.petugas')

@section('title','Data Pengiriman')

@section('content')

<style>
.container {
    padding: 20px;
}

.kartu {
    display: flex;
    gap: 20px;
    background: white;
    padding: 20px;
    border-radius: 14px;
    margin-bottom:20px;
    align-items: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.kartu img {
    width: 140px;
    height:140px;
    border-radius: 10px;
    object-fit: cover;
    background:#eee;
}

.detail {
    flex: 1;
    font-size:14px;
    line-height:1.7;
}

.detail h3{
    margin-bottom:10px;
}

/* STATUS */
.status {
    padding:6px 14px;
    border-radius:20px;
    font-size:12px;
    display:inline-block;
    font-weight:bold;
}

.diproses { background:orange; color:white; }
.dibayar { background:#28a745; color:white; }
.siap { background:#6c757d; color:white; }
.dikirim { background:#007bff; color:white; }
.menuju { background:#17a2b8; color:white; }
.sampai { background:green; color:white; }

/* BOX */
.status-box {
    width: 230px;
}

.status-box h4 {
    background: #1E3A8A;
    color: white;
    padding: 8px;
    text-align: center;
    border-radius: 10px;
    margin-bottom: 10px;
    font-size:14px;
}

.status-box select {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: none;
    background: #eee;
    margin-bottom: 10px;
    cursor: pointer;
}

.btn-update {
    width:100%;
    padding:10px;
    border:none;
    border-radius:10px;
    background:#1E3A8A;
    color:white;
    cursor:pointer;
    font-weight:bold;
}

.btn-update:hover{
    background:#163172;
}

/* VERIFIKASI */
.btn-verif {
    width:100%;
    padding:10px;
    border:none;
    border-radius:10px;
    background:green;
    color:white;
    cursor:pointer;
    margin-bottom:10px;
    font-weight:bold;
}

/* BUKTI */
.bukti-box {
    width: 140px;
    text-align: center;
}

.bukti-img {
    width: 100px;
    margin-top: 8px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.2s;
}

.bukti-img:hover {
    transform: scale(1.05);
}

.alert-success{
    background:#d4edda;
    color:#155724;
    padding:10px;
    border-radius:8px;
    margin-bottom:15px;
}

.alert-warning{
    background:#fff3cd;
    color:#856404;
    padding:8px;
    border-radius:6px;
    font-size:13px;
}
</style>

<div class="container">

<h2>DATA PENGIRIMAN</h2>

@if(session('success'))
<div class="alert-success">
    {{ session('success') }}
</div>
@endif

@forelse($pesanans as $p)

<div class="kartu">

    <!-- GAMBAR -->
    <img src="{{ asset('images/'.($p->image ?? 'boxy.jpg')) }}">

    <!-- DETAIL -->
    <div class="detail">
        <h3>Pesanan {{ $p->nama_pembeli }}</h3>

        <p>Nama Barang : {{ $p->nama_barang }}</p>
        <p>Total Harga : Rp {{ number_format($p->total_harga,0,',','.') }}</p>
        <p>Ukuran : {{ $p->ukuran }}</p>
        <p>Alamat : {{ $p->alamat }}</p>

        <p>Status :
            <span class="status {{ $p->status }}">
                {{ ucfirst($p->status) }}
            </span>
        </p>
    </div>

    <!-- BUKTI -->
    <div class="bukti-box">
        @if($p->bukti)
            <p><strong>Bukti</strong></p>
            <a href="{{ asset('bukti/'.$p->bukti) }}" target="_blank">
                <img src="{{ asset('bukti/'.$p->bukti) }}" class="bukti-img">
            </a>
        @else
            <div class="alert-warning">
                Belum upload
            </div>
        @endif
    </div>

    <!-- UPDATE -->
    <div class="status-box">

        <h4>Update Status</h4>

        <!-- ✅ VERIFIKASI (FIXED) -->
        @if($p->bukti && $p->status == 'diproses')
        <form method="POST" action="{{ route('petugas.pengiriman.update', $p->id) }}">
            @csrf
            <input type="hidden" name="status" value="dibayar">
            <button class="btn-verif">
                ✔ Verifikasi Pembayaran
            </button>
        </form>
        @endif

        <!-- UPDATE NORMAL -->
        <form method="POST" action="{{ route('petugas.pengiriman.update', $p->id) }}">
            @csrf

            <select name="status">
                <option value="diproses" {{ $p->status=='diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="dibayar" {{ $p->status=='dibayar' ? 'selected' : '' }}>Sudah Dibayar</option>
                <option value="siap" {{ $p->status=='siap' ? 'selected' : '' }}>Siap Dikirim</option>
                <option value="dikirim" {{ $p->status=='dikirim' ? 'selected' : '' }}>Dikirim</option>
                <option value="menuju" {{ $p->status=='menuju' ? 'selected' : '' }}>Menuju</option>
                <option value="sampai" {{ $p->status=='sampai' ? 'selected' : '' }}>Sampai</option>
            </select>

            <button type="submit" class="btn-update">
                Update Status
            </button>

        </form>

    </div>

</div>

@empty
<p>Tidak ada pesanan.</p>
@endforelse

</div>

@endsection