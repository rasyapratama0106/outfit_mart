<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrasi - OutfitMart</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    height:100vh;
    width:100%;
    font-family: Arial, sans-serif;
    background:#dcdcdc;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* CONTAINER FULL */
.container{
    width:100%;
    height:100%;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
}

/* LOGO */
.logo{
    margin-bottom:30px;
    font-weight:bold;
    font-size:22px;
    color:#0a3d91;
}

/* TITLE */
.title{
    font-size:28px;
    margin-bottom:40px;
}

/* FORM */
form{
    width:400px;
    display:flex;
    flex-direction:column;
}

input{
    padding:12px;
    margin-bottom:20px;
    border:none;
    border-bottom:1px solid #aaa;
    background:transparent;
    outline:none;
}

/* BUTTON */
button{
    padding:12px;
    border:none;
    border-radius:25px;
    background:#0a3d91;
    color:white;
    font-weight:bold;
    cursor:pointer;
    margin-top:10px;
}

button:hover{
    opacity:0.9;
}

.bottom-text{
    margin-top:20px;
    font-size:14px;
}

.bottom-text a{
    color:#0a3d91;
    text-decoration:none;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="container">

    <div class="logo">OutfitMart</div>
    <div class="title">BUAT AKUN</div>

    <form method="POST" action="{{ route('register.post') }}">
    @csrf

    @if ($errors->any())
        <div style="color:red; margin-bottom:15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <input type="text" name="name" placeholder="Nama Lengkap" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Daftar</button>
</form>

    <div class="bottom-text">
        Sudah Punya Akun? <a href="login.html">Login</a>
    </div>

</div>

</body>
</html>
