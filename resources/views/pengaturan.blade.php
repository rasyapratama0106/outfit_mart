@extends('layouts.app')

@section('title','Pengaturan Akun')

@section('content')

<link href="https://unpkg.com/cropperjs/dist/cropper.min.css" rel="stylesheet"/>
<script src="https://unpkg.com/cropperjs"></script>

<style>

/* BACKGROUND */
body{
    margin:0;
    font-family:'Segoe UI', sans-serif;
    background:linear-gradient(135deg, #1e3a8a, #2563eb);
}

/* WRAPPER */
.wrapper{
    max-width:1000px;
    margin:50px auto;
}

/* HEADER */
.header-box{
    background:white;
    border-radius:20px;
    padding:25px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;

    box-shadow:0 15px 40px rgba(0,0,0,0.2);
}

/* KIRI (PROFIL) */
.profile-area{
    display:flex;
    align-items:center;
    gap:20px;
}

.profile-img{
    width:95px;
    height:95px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #1E3A8A;
}

/* INFO */
.user-info b{
    font-size:16px;
}

.aksi-text{
    color:#1E3A8A;
    font-weight:bold;
    cursor:pointer;
    font-size:13px;
}

/* KANAN (LOGO BESAR) */
.logo-big{
    height:100px;
}

/* CARD */
.setting-container{
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 15px 40px rgba(0,0,0,0.2);
}

/* FORM */
.form-group{
    margin-bottom:20px;
}

.form-group label{
    font-size:13px;
    color:#666;
    display:block;
    margin-bottom:5px;
}

.form-group input{
    width:100%;
    padding:12px;
    border-radius:10px;
    border:1px solid #ddd;
}

.form-group input:focus{
    border-color:#1E3A8A;
    outline:none;
    box-shadow:0 0 0 3px rgba(30,58,138,0.1);
}

/* BUTTON */
.btn-save{
    width:100%;
    background:#1E3A8A;
    color:white;
    padding:12px;
    border:none;
    border-radius:30px;
    font-weight:bold;
    cursor:pointer;
}

.btn-save:hover{
    background:#162d6b;
}

/* PREVIEW */
#preview{
    max-width:200px;
    margin-top:15px;
    border-radius:12px;
    display:none;
}

/* RESPONSIVE */
@media (max-width:768px){
    .header-box{
        flex-direction:column;
        gap:15px;
        text-align:center;
    }

    .logo-big{
        height:80px;
    }
}

</style>

<div class="wrapper">

    <!-- HEADER -->
    <div class="header-box">

        <!-- KIRI (PROFIL) -->
        <div class="profile-area">

            <img src="{{ Auth::user()->photo ? asset('profile/'.Auth::user()->photo) : 'https://via.placeholder.com/95' }}"
                 class="profile-img">

            <div class="user-info">
                <b>{{ Auth::user()->name }}</b><br>

                <span id="aksi-profil" class="aksi-text">
                    {{ Auth::user()->photo ? 'Ganti / Hapus Foto' : 'Tambah Foto' }}
                </span>
            </div>

        </div>

        <!-- KANAN (LOGO BESAR) -->
        <img src="{{ asset('images/outfitmart.png') }}" class="logo-big">

    </div>

    <!-- FORM -->
    <div class="setting-container">

        <form id="form-profil" action="{{ route('akun.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}">
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ Auth::user()->alamat }}">
        </div>

        <input type="file" name="photo" id="inputImage" accept="image/*" style="display:none;">
        <input type="hidden" name="photo_cropped" id="photo_cropped">

        <img id="preview">

        <button type="submit" class="btn-save">
            Simpan Perubahan
        </button>

        </form>

    </div>

</div>

<script>
// JS TETAP
let aksi = document.getElementById('aksi-profil');
let input = document.getElementById('inputImage');
let preview = document.getElementById('preview');
let cropped = document.getElementById('photo_cropped');
let form = document.getElementById('form-profil');

let cropper;

aksi.addEventListener('click', function(){

    let adaFoto = "{{ Auth::user()->photo }}" !== "";

    if(!adaFoto){
        input.click();
    } else {
        let pilih = confirm("OK = Ganti Foto\nCancel = Hapus Foto");

        if(pilih){
            input.click();
        } else {
            if(confirm("Yakin hapus foto?")){
                let hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'hapus_foto';
                hidden.value = '1';
                form.appendChild(hidden);
                form.submit();
            }
        }
    }
});

input.addEventListener('change', function(e){
    let file = e.target.files[0];
    if(!file) return;

    let reader = new FileReader();

    reader.onload = function(){
        preview.src = reader.result;
        preview.style.display = 'block';

        if(cropper){
            cropper.destroy();
        }

        cropper = new Cropper(preview,{
            aspectRatio:1,
            viewMode:1
        });
    }

    reader.readAsDataURL(file);
});

form.addEventListener('submit', function(e){
    if(cropper){
        e.preventDefault();

        let canvas = cropper.getCroppedCanvas({
            width:300,
            height:300
        });

        if(canvas){
            cropped.value = canvas.toDataURL('image/jpeg');
        }

        form.submit();
    }
});
</script>

@endsection