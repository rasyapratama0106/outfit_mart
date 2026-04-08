<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - OutfitMart</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background-color:#f5f5f5;
            font-family:Arial, sans-serif;
        }

        .login-container { width:400px; text-align:center; }

        .logo { width:160px; margin-bottom:60px; }

        .login-title {
            font-family:'Orbitron', sans-serif;
            font-size:36px;
            letter-spacing:6px;
            font-weight:700;
            margin-bottom:40px;
        }

        .input-group { margin-bottom:25px; text-align:left; }

        .input-group input {
            width:100%;
            border:none;
            border-bottom:1px solid #999;
            padding:10px 5px;
            outline:none;
            background:transparent;
        }

        .btn-login {
            width:100%;
            padding:12px;
            border-radius:25px;
            border:none;
            background-color:#0f4c81;
            color:white;
            font-size:14px;
            cursor:pointer;
        }

        .register { margin-top:20px; font-size:14px; }

        .register a {
            text-decoration:none;
            color:#0f4c81;
            font-weight:bold;
        }

        .alert-success {
            background:#d4edda;
            color:#155724;
            padding:10px;
            margin-bottom:20px;
            border-radius:5px;
        }

        .alert-error {
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

    {{-- NOTIF SUKSES REGISTER --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="input-group">
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit" class="btn-login">Masuk</button>
    </form>

    <div class="register">
        Belum Punya Akun? <a href="{{ route('register') }}">Buat Akun</a>
    </div>

</div>

</body>
</html>