<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Petugas - OutfitMart</title>

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

    <div class="login-title">LOGIN PETUGAS</div>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('petugas.login.post') }}" autocomplete="off">
        @csrf

        <div class="input-group">
            <input type="text" name="email" placeholder="Email" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit" class="btn-login">Masuk</button>
    </form>

</div>

</body>
</html>