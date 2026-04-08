<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pesanan</title>

<style>
body{
font-family:Arial;
background:#dcdcdc;
margin:0;
padding:30px;
}

.container{
max-width:1200px;
margin:auto;
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:40px;
}

.back{
font-size:28px;
cursor:pointer;
}

.logo-img{
height:60px;
}

.content{
display:flex;
gap:60px;
align-items:center;
}

.product-img{
width:350px;
height:350px;
object-fit:cover;
}

.detail{
display:flex;
flex-direction:column;
gap:15px;
}

/* 🔥 FIX JUDUL + LOVE */
.title-row{
display:flex;
justify-content:space-between;
align-items:center;
}

.title-row h2{
margin:0;
}

.love-btn{
background:none;
border:none;
cursor:pointer;
}

/* SIZE */
.price{
font-size:22px;
font-weight:bold;
}

.size-options{
display:flex;
gap:10px;
margin-top:10px;
}

.size-btn{
padding:8px 18px;
border-radius:20px;
border:1px solid #ccc;
background:white;
cursor:pointer;
font-weight:bold;
}

.size-btn.active{
background:#0a3d91;
color:white;
border-color:#0a3d91;
}

.btn{
margin-top:10px;
padding:12px;
border-radius:25px;
border:none;
background:#0a3d91;
color:white;
font-weight:bold;
cursor:pointer;
width:220px;
}
</style>
</head>

<body>

<div class="container">

<div class="header">
<div onclick="window.history.back()" class="back">← Pesanan</div>
<img src="{{ asset('images/outfitmart.png') }}" class="logo-img">
</div>

<div class="content">

<img src="{{ asset('images/'.$product->image) }}" class="product-img">

<div class="detail">

<!-- 🔥 JUDUL + LOVE FIX TOTAL -->
<div class="title-row">

    <h2>{{ $product->name }}</h2>

    @auth
    <form action="{{ route('favorite.toggle', $product->id) }}" method="POST">
        @csrf

        @php
            $liked = \App\Models\Favorite::where('user_id', auth()->id())
                        ->where('product_id', $product->id)
                        ->exists();
        @endphp

        <button class="love-btn">

            @if($liked)
            <!-- ❤️ MERAH -->
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="red" viewBox="0 0 24 24">
                <path d="M12 21s-6.7-4.6-9.4-8.1C-0.3 9.6 1.1 4.5 5.5 3.3c2-.6 4.1.1 5.5 1.6 1.4-1.5 3.5-2.2 5.5-1.6 4.4 1.2 5.8 6.3 2.9 9.6C18.7 16.4 12 21 12 21z"/>
            </svg>
            @else
            <!-- 🤍 OUTLINE -->
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" stroke="black" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 21s-6.7-4.6-9.4-8.1C-0.3 9.6 1.1 4.5 5.5 3.3c2-.6 4.1.1 5.5 1.6 1.4-1.5 3.5-2.2 5.5-1.6 4.4 1.2 5.8 6.3 2.9 9.6C18.7 16.4 12 21 12 21z"/>
            </svg>
            @endif

        </button>
    </form>
    @endauth

</div>

<div class="price">
Rp {{ number_format($product->price,0,',','.') }}
</div>

<p>Pilih Ukuran</p>

<div class="size-options">
<button type="button" class="size-btn" data-size="S">S</button>
<button type="button" class="size-btn" data-size="M">M</button>
<button type="button" class="size-btn" data-size="L">L</button>
<button type="button" class="size-btn" data-size="XL">XL</button>
</div>

<form action="{{ url('tambah-ke-keranjang') }}" method="POST" id="formKeranjang">
@csrf
<input type="hidden" name="id" value="{{ $product->id }}">
<input type="hidden" name="size" id="selectedSize">
<button type="submit" class="btn">Masukkan Keranjang</button>
</form>

<form action="{{ url('pembayaran/'.$product->id) }}" method="GET" id="formBeli">
<input type="hidden" name="size" id="selectedSize2">
<button type="submit" class="btn">Beli Sekarang</button>
</form>

</div>

</div>

</div>

<script>

let selectedSize = "";

document.querySelectorAll(".size-btn").forEach(btn=>{
btn.addEventListener("click",function(){

document.querySelectorAll(".size-btn").forEach(b=>b.classList.remove("active"))

this.classList.add("active")

selectedSize = this.dataset.size

document.getElementById("selectedSize").value = selectedSize
document.getElementById("selectedSize2").value = selectedSize

})
})

document.getElementById("formKeranjang").addEventListener("submit",function(e){
if(selectedSize===""){
e.preventDefault()
alert("Pilih ukuran dulu!")
}
})

document.getElementById("formBeli").addEventListener("submit",function(e){
if(selectedSize===""){
e.preventDefault()
alert("Pilih ukuran dulu sebelum beli!")
}
})

</script>

</body>
</html>