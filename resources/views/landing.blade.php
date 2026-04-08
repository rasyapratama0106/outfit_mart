<!DOCTYPE html>
<html>
<head>
    <title>OutfitMart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body{
            margin:0;
            font-family: 'Crimson Text', serif;
            background:#f5f5f5;
        }

        .container{
            max-width:1200px;
            margin:auto;
            padding:20px 40px;
        }

        /* ===== NAVBAR ===== */
        .navbar{
            display:flex;
            align-items:center;
            justify-content:space-between;
        }

        .nav-left{
            display:flex;
            align-items:center;
            gap:20px;
        }

        .logo{
            height:60px;
        }

        .search-box{
            background:#ddd;
            border-radius:40px;
            padding:10px 20px;
            width:400px;
            border:none;
        }

        .nav-right{
            display:flex;
            gap:25px;
            font-size:22px;
        }

        .nav-right a{
            text-decoration:none;
            color:black;
        }

        /* ===== HERO ===== */
        .hero{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-top:40px;
        }

        .hero-text h1{
            font-size:55px;
            margin:0;
        }

        .hero-text span{
            color:#D4AF37;
        }

        .hero-text p{
            font-size:18px;
            margin:15px 0;
        }

        .btn-login{
            background:#1E3A8A;
            color:#D4AF37;
            padding:12px 35px;
            border-radius:30px;
            text-decoration:none;
        }

        .hero-image{
            background:linear-gradient(180deg,#517EF3 0%,white 100%);
            border-top-left-radius:200px;
            border-bottom-right-radius:120px;
            padding:20px;
        }

        .hero-image img{
            width:350px;
        }

        /* ===== KOLEKSI ===== */
        .koleksi{
            background:#1E3A8A;
            padding:20px;
            text-align:center;
            color:#D4AF37;
            margin-top:40px;
            font-size:30px;
        }

        /* ===== PRODUCT GRID ===== */
        .products{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:18px;
    margin-top:30px;
}

.card{
    background:white;
    border-radius:10px; /* lebih rapi */
    padding:12px;
    text-align:center;
    box-shadow:0 2px 6px rgba(0,0,0,0.08); /* shadow lebih halus */
    transition:0.2s ease;
}

.card:hover{
    transform:translateY(-3px);
}

.card img{
    max-width: 100%;
    height: 180px;       /* kecilkan tinggi */
    object-fit: contain; /* tidak terpotong */
    background: #f8f8f8; /* biar tidak kosong putih */
    border-radius: 8px;
}

.card h4{
    margin:8px 0 4px;
    font-size:14px;
    font-weight:500;
}

.card p{
    font-size:14px;
    font-weight:bold;
}

        @media(max-width:768px){
            .hero{
                flex-direction:column;
                text-align:center;
            }

            .search-box{
                width:200px;
            }

            .products{
                grid-template-columns:1fr 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="nav-left">
            <img src="{{ asset('images/outfitmart.png') }}" class="logo">

            <input type="text" placeholder="cari di sini" class="search-box">
        </div>

        <div class="nav-right">
    <a href="{{ url('/login') }}" class="nav-icon">👤</a>
    <a href="{{ url('/login') }}" class="nav-icon">🛒</a>
    <a href="{{ url('/login') }}" class="nav-icon">❤</a>
</div>
    </div>

    <!-- HERO -->
    <div class="hero">
        <div class="hero-text">
            <h1>
                Selamat Datang,<br>
                Di <span>OutfitMart</span>
            </h1>
            <p>silakan login terlebih dahulu</p>
            <a href="{{ url('/login') }}" class="btn-login">LOGIN</a>
        </div>

        <div class="hero-image">
            <img src="{{ asset('images/model1.png') }}">
        </div>
    </div>

</div>

<!-- KOLEKSI -->
<div class="koleksi">
    Koleksi Terbaru
</div>

<div class="container">
    <div class="products">

        <div class="card">
            <img src="{{ asset('images/boxy.jpg') }}">
            <h4>baju boxy pria & wanita</h4>
            <p>RP 92.000</p>
        </div>

        <div class="card">
            <img src="{{ asset('images/nicky.jpg') }}">
            <h4>Kaos Nicky Casual</h4>
            <p>RP 95.000</p>
        </div>

        <div class="card">
            <img src="{{ asset('images/rucas.webp') }}">
            <h4>Kaos rucas</h4>
            <p>RP 350.000</p>
        </div>

        <div class="card">
            <img src="{{ asset('images/compas.jpeg') }}">
            <h4>Tshirt Compas</h4>
            <p>RP 113.000</p>
        </div>

        <div class="card">
            <img src="{{ asset('images/distro.jpg') }}">
            <h4>Kaos Distro Terbaru</h4>
            <p>RP 82.000</p>
        </div>

        <div class="card">
            <img src="{{ asset('images/puma.avif') }}">
            <h4>t-shirt puma</h4>
            <p>RP 305.000</p>
        </div>

    </div>
</div>

</body>
</html>