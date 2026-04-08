<!DOCTYPE html>
<html>
<head>
<title>Pembayaran</title>

<style>

/* BACKGROUND */
body{
    margin:0;
    font-family:Arial;
    background:#f5f7fb;
}

/* HEADER */
.header{
    background:#111;
    color:white;
    padding:14px 25px;
    font-weight:600;
    letter-spacing:0.5px;
}

/* CONTAINER */
.container{
    max-width:1100px;
    margin:auto;
    padding:30px 20px;
}

/* TOP BAR */
.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.back-link{
    text-decoration:none;
    color:#1e3a8a;
    font-weight:500;
}

.logo{
    height:70px;
}

/* MAIN CONTENT */
.content{
    display:flex;
    gap:30px;
}

/* CARD */
.card{
    background:white;
    padding:20px;
    border-radius:16px;
    box-shadow:0 6px 18px rgba(0,0,0,0.05);
}

/* LEFT */
.left{
    flex:1;
}

/* RIGHT */
.right{
    flex:1;
}

/* TITLE */
.section-title{
    font-size:16px;
    font-weight:600;
    margin-bottom:15px;
}

/* PAYMENT METHOD */
.method{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:12px 15px;
    border-radius:12px;
    border:1px solid #eee;
    margin-bottom:10px;
    cursor:pointer;
    transition:0.2s;
}

.method:hover{
    border:1px solid #1e3a8a;
    background:#f0f4ff;
}

.method img{
    height:25px;
}

/* ORDER */
.order-box{
    display:flex;
    gap:15px;
}

.product-img{
    width:140px;
    border-radius:12px;
    border:1px solid #eee;
}

/* TEXT */
.order-text p{
    margin:4px 0;
    font-size:14px;
    color:#555;
}

/* TOTAL */
.total{
    margin-top:10px;
    font-size:16px;
    font-weight:600;
}

.total span{
    color:#1e3a8a;
}

/* BUTTON */
.btn-pay{
    margin-top:15px;
    width:100%;
    background:#1e3a8a;
    color:white;
    padding:12px;
    border:none;
    border-radius:25px;
    font-size:14px;
    cursor:pointer;
    transition:0.2s;
}

.btn-pay:hover{
    background:#162d6b;
}

/* RESPONSIVE */
@media (max-width:768px){
    .content{
        flex-direction:column;
    }

    .order-box{
        flex-direction:column;
        align-items:flex-start;
    }

    .product-img{
        width:100%;
    }
}

</style>
</head>

<body>

<div class="header">
Checkout Pembayaran
</div>

<div class="container">

<div class="top-bar">

<a href="{{ url()->previous() }}" class="back-link">
← Kembali
</a>

<img src="{{ asset('images/outfitmart.png') }}" class="logo">

</div>

<form action="{{ route('pembayaran.proses', $id) }}" method="POST">
@csrf

<div class="content">

<!-- LEFT -->
<div class="left card">

<div class="section-title">Metode Pembayaran</div>

<label class="method">
    <img src="{{ asset('images/qris.png') }}">
    <input type="radio" name="payment" value="qris" required>
</label>

<label class="method">
    <img src="{{ asset('images/dana.png') }}">
    <input type="radio" name="payment" value="dana">
</label>

<label class="method">
    <img src="{{ asset('images/gopay.png') }}">
    <input type="radio" name="payment" value="gopay">
</label>

</div>

<!-- RIGHT -->
<div class="right card">

<div class="section-title">Rincian Pesanan</div>

<div class="order-box">

<img src="{{ asset('images/'.$item['image']) }}" class="product-img">

<div class="order-text">
    <p><b>{{ $item['name'] }}</b></p>
    <p>Harga : Rp {{ number_format((int)$item['price'],0,',','.') }}</p>
    <p>Ukuran : {{ $item['size'] }}</p>
    <p>Ongkir : Rp 5.500</p>

    <div class="total">
        Total : 
        <span>
        Rp {{ number_format((int)$item['price'] + 5500,0,',','.') }}
        </span>
    </div>
</div>

</div>

<button type="submit" class="btn-pay">
Bayar Sekarang
</button>

</div>

</div>

</form>

</div>

</body>
</html>