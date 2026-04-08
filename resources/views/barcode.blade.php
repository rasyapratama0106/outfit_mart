<!DOCTYPE html>
<html>
<head>
<title>QR Pembayaran</title>

<style>
body{
margin:0;
font-family:Arial;
background:linear-gradient(135deg,#0f4c81,#0b2f6b);
display:flex;
flex-direction:column;
align-items:center;
justify-content:center;
height:100vh;
color:white;
}

.card{
background:white;
color:black;
padding:25px;
border-radius:15px;
width:350px;
text-align:center;
box-shadow:0 10px 25px rgba(0,0,0,0.3);
}

img{
width:100%;
border-radius:10px;
}

.title{
font-weight:bold;
margin-bottom:10px;
}

.btn{
margin-top:15px;
background:#0f4c81;
color:white;
padding:10px;
border:none;
border-radius:20px;
width:100%;
cursor:pointer;
}
</style>
</head>

<body>

<h2>Scan & Bayar</h2>

<div class="card">

<div class="title">{{ strtoupper($metode) }}</div>

@if($metode == 'dana')
    <img src="{{ asset('images/qrdana.jpeg') }}">
@elseif($metode == 'gopay')
    <img src="{{ asset('images/qrgopay.jpeg') }}">
@elseif($metode == 'qris')
    <img src="{{ asset('images/qris.png') }}">
@endif

<p>Upload bukti setelah pembayaran</p>

<form action="{{ url('upload-bukti/'.$id) }}" method="POST" enctype="multipart/form-data">
@csrf

<input type="file" name="bukti" required>

<button class="btn">Kirim Bukti</button>

</form>

</div>

</body>
</html>