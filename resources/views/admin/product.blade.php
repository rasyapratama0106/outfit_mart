@extends('layouts.admin')

@section('title', 'Data Produk')

@section('content')

<style>
.product-list{
    background:#d9d9d9;
    padding:20px;
    border-radius:10px;
}

.product-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:15px;
    background:white;
    padding:10px 15px;
    border-radius:10px;
}

.product-info{
    display:flex;
    align-items:center;
    gap:15px;
}

.product-name{
    width:220px;
    font-weight:bold;
}

.btn{
    background:#eee;
    border:none;
    padding:6px 15px;
    border-radius:20px;
    cursor:pointer;
}

.btn:hover{
    background:#ccc;
}

.product-img{
    width:60px;
    height:60px;
    object-fit:cover;
    border-radius:10px;
}

/* TAMBAH PRODUK */
.add-section{
    background:#eee;
    padding:15px;
    margin-top:15px;
    border-radius:10px;
}

.add-btn{
    background:#2e5aac;
    color:white;
    border:none;
    padding:6px 12px;
    cursor:pointer;
    margin-bottom:10px;
    border-radius:6px;
}

.add-product{
    display:flex;
    align-items:center;
    gap:10px;
}

input{
    padding:6px;
    border-radius:10px;
    border:1px solid #ccc;
}

.finish{
    margin-left:auto;
    background:#2e5aac;
    color:white;
    border:none;
    padding:6px 20px;
    border-radius:20px;
    cursor:pointer;
}
</style>

{{-- ALERT --}}
@if(session('success'))
<div style="background:#d4edda; padding:10px; border-radius:8px; margin-bottom:10px;">
    {{ session('success') }}
</div>
@endif

{{-- LIST PRODUK --}}
<div class="product-list">

@foreach($products as $index => $p)
<div class="product-item">
<div class="product-info">
<span>{{ $index + 1 }}.</span>
<div>
    <div class="product-name">{{ $p->name }}</div>
    <div style=color:#16a34a; font-weight:bold;">
        Rp {{ number_format($p->price, 0, ',', '.') }}
    </div>
</div>

<form action="{{ route('admin.product.delete', $p->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
@csrf
@method('DELETE')
<button class="btn" style="color:red;">🗑️</button>
</form>

<a href="{{ route('admin.product.edit', $p->id) }}">
<button class="btn">Edit</button>
</a>

</div>

<img src="{{ asset('images/'.$p->image) }}" class="product-img">
</div>
@endforeach

</div>

{{-- TAMBAH PRODUK --}}
<div class="add-section">

<button class="add-btn" onclick="toggleForm()">+ Tambah Produk</button>

<form action="{{ route('admin.product.tambah') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="add-product" id="formProduk" style="display:none;">
<input type="text" name="name" placeholder="Nama Produk" required>

<!-- 🔥 INPUT RUPIAH -->
<input type="text" name="price" id="price" placeholder="Rp 0" required>

<input type="file" name="image" required>
<button type="submit" class="finish">Selesai</button>
</div>

</form>

</div>

<script>
function toggleForm(){
    var form=document.getElementById("formProduk");
    form.style.display = (form.style.display === "none") ? "flex" : "none";
}

// 🔥 FORMAT RUPIAH
const inputHarga = document.getElementById('price');

inputHarga.addEventListener('keyup', function(){
    let angka = this.value.replace(/[^0-9]/g, '');
    
    if(angka){
        this.value = 'Rp ' + formatRupiah(angka);
    }else{
        this.value = '';
    }
});

function formatRupiah(angka){
    return angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>

@endsection