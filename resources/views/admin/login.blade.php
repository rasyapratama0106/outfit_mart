<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login - OutfitMart</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:#f5f5f5;
font-family:Arial;
}

.login-container{
width:420px;
text-align:center;
background:white;
padding:40px;
border-radius:10px;
box-shadow:0 10px 30px rgba(0,0,0,0.1);
}

.logo{
width:150px;
margin-bottom:30px;
}

.login-title{
font-family:'Orbitron', sans-serif;
font-size:34px;
letter-spacing:6px;
font-weight:700;
margin-bottom:5px;
}

.admin-label{
font-size:14px;
color:#777;
margin-bottom:30px;
}

.input-group{
margin-bottom:25px;
text-align:left;
}

.input-group input{
width:100%;
border:none;
border-bottom:1px solid #999;
padding:10px 5px;
outline:none;
background:transparent;
}

.btn-login{
width:100%;
padding:12px;
border-radius:25px;
border:none;
background:#1E3A8A;
color:white;
font-size:14px;
cursor:pointer;
}

.btn-login:hover{
background:#16306f;
}

.alert-success{
background:#d4edda;
color:#155724;
padding:10px;
margin-bottom:20px;
border-radius:5px;
}

.alert-error{
background:#f8d7da;
color:#721c24;
padding:10px;
margin-bottom:20px;
border-radius:5px;
}

</style>

</head>
<body>

<div class="login-container">

<img src="{{ asset('images/outfitmart.png') }}" class="logo">

<div class="login-title">LOGIN</div>
<div class="admin-label">ADMIN PANEL</div>

@if ($errors->any())
<div class="alert-error">
@foreach ($errors->all() as $error)
<div>{{ $error }}</div>
@endforeach
</div>
@endif

<form method="POST" action="/admin/login">
@csrf

<div class="input-group">
<input type="email" name="email" placeholder="Email Admin" required>
</div>

<div class="input-group">
<input type="password" name="password" placeholder="Password" required>
</div>

<button type="submit" class="btn-login">Masuk Admin</button>

</form>

</div>

</body>
</html>