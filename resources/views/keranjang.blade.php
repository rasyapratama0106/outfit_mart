<!DOCTYPE html>
<html>
<head>
<title>Keranjang Saya</title>

<style>

/* BACKGROUND */
body{
    font-family:Arial;
    background:#f5f7fb;
    padding:30px;
}

/* TITLE */
h2{
    margin-bottom:20px;
    font-weight:600;
}

/* BOX */
.cart-box{
    background:#dcdcdc;
    padding:25px;
    border-radius:15px;
}

/* ITEM */
.cart-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:white;
    padding:15px;
    border-radius:12px;
    margin-bottom:12px;

    box-shadow:0 4px 10px rgba(0,0,0,0.05);
    transition:0.2s;
}

.cart-item:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 18px rgba(0,0,0,0.08);
}

/* LEFT */
.cart-left{
    display:flex;
    align-items:center;
    gap:15px;
}

.cart-left img{
    width:80px;
    height:80px;
    object-fit:cover;
    border-radius:10px;
    border:1px solid #eee;
}

/* INFO */
.cart-info p{
    margin:0;
    font-weight:600;
    font-size:14px;
    color:#111;
}

.cart-size{
    font-size:12px;
    color:#666;
    margin:3px 0;
}

.price{
    color:#1e3a8a;
    font-weight:600;
}

/* RIGHT */
.cart-right{
    display:flex;
    align-items:center;
    gap:20px;
}

.qty{
    font-weight:600;
    font-size:14px;
}

/* BUTTON GROUP */
.action-buttons{
    display:flex;
    flex-direction:column;
    gap:8px;
}

/* BUTTON */
.btn{
    padding:7px 14px;
    border:none;
    border-radius:20px;
    cursor:pointer;
    text-decoration:none;
    text-align:center;
    font-size:12px;
    transition:0.2s;
}

/* BUY */
.btn-buy{
    background:#1e3a8a;
    color:white;
}

.btn-buy:hover{
    background:#162d6b;
}

/* DELETE */
.btn-delete{
    background:#ef4444;
    color:white;
}

.btn-delete:hover{
    background:#dc2626;
}

/* TOTAL BOX */
.total-box{
    margin-top:20px;
    text-align:right;
    font-weight:600;
    font-size:16px;
}

.total-box span{
    color:#1e3a8a;
}

/* EMPTY */
.empty{
    text-align:center;
    padding:40px;
    color:#777;
}

/* BACK BUTTON */
.back-btn{
    display:inline-block;
    margin-top:20px;
    padding:10px 18px;
    background:#1e3a8a;
    color:white;
    border-radius:25px;
    text-decoration:none;
    transition:0.2s;
}

.back-btn:hover{
    background:#162d6b;
}

/* RESPONSIVE */
@media (max-width:768px){
    .cart-item{
        flex-direction:column;
        align-items:flex-start;
        gap:10px;
    }

    .cart-right{
        width:100%;
        justify-content:space-between;
    }
}

</style>
</head>

<body>

<h2>Keranjang Saya</h2>

<div class="cart-box">

@php $total = 0; @endphp

@if($cart && count($cart) > 0)

@foreach($cart as $id => $item)

@php
$subtotal = $item['price'] * $item['qty'];
$total += $subtotal;
@endphp

<div class="cart-item">

    <!-- LEFT -->
    <div class="cart-left">
        <img src="{{ asset('images/'.$item['image']) }}">

        <div class="cart-info">
            <p>{{ $item['name'] }}</p>

            <div class="cart-size">
                Ukuran : {{ $item['size'] }}
            </div>

            <div class="price">
                Rp {{ number_format($item['price'],0,',','.') }}
            </div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="cart-right">

        <div class="qty">
            x{{ $item['qty'] }}
        </div>

        <div class="action-buttons">

            <a href="{{ url('pembayaran/'.$id) }}" class="btn btn-buy">
                Beli
            </a>

            <a href="{{ url('hapus-keranjang/'.$id) }}" class="btn btn-delete">
                Hapus
            </a>

        </div>

    </div>

</div>

@endforeach

<div class="total-box">
    Total : <span>Rp {{ number_format($total,0,',','.') }}</span>
</div>

@else

<div class="empty">
    Keranjang kamu masih kosong 🛒
</div>

@endif

</div>

<a href="{{ url('home') }}" class="back-btn">
← Kembali ke Home
</a>

</body>
</html>