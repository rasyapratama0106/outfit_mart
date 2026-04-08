@extends('layouts.admin')

@section('title','Edit Produk')

@section('content')

<style>

.container{
    display:flex;
    gap:30px;
    padding:20px;
}

/* KIRI - GAMBAR */
.preview{
    background:white;
    padding:20px;
    border-radius:12px;
    width:300px;
    text-align:center;
}

.preview img{
    width:100%;
    height:300px;
    object-fit:cover;
    border-radius:10px;
}

/* KANAN - FORM */
.form-box{
    background:white;
    padding:20px;
    border-radius:12px;
    flex:1;
}

.input{
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border-radius:8px;
    border:1px solid #ccc;
}

.label{
    font-weight:bold;
    margin-bottom:5px;
    display:block;
}

.btn{
    background:#2e5aac;
    color:white;
    border:none;
    padding:10px 20px;
    border-radius:8px;
    cursor:pointer;
}

.btn:hover{
    background:#1e3a8a;
}

.back{
    display:inline-block;
    margin-bottom:15px;
    text-decoration:none;
    color:#2e5aac;
    font-weight:bold;
}

</style>

<a href="/admin/produk" class="back">← Kembali</a>

<div class="container">

    <!-- GAMBAR -->
    <div class="preview">
        <img src="{{ asset('images/'.$product->image) }}" id="previewImg">
    </div>

    <!-- FORM -->
    <div class="form-box">

        <form action="/admin/produk/update/{{ $product->id }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="label">Nama Produk</label>
        <input type="text" name="name" value="{{ $product->name }}" class="input">

        <label class="label">Harga</label>
        <input type="text" name="price" value="{{ $product->price }}" class="input">

        <label class="label">Ganti Gambar</label>
        <input type="file" name="image" class="input" onchange="previewImage(event)">

        <br>
        <button class="btn">Simpan Perubahan</button>

        </form>

    </div>

</div>

<script>
function previewImage(event){
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('previewImg').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

@endsection