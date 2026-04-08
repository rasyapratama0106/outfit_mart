@extends('layouts.admin')

@section('title', 'Data User')

@section('content')

<style>

.user-card{
    background:#d9d9d9;
    padding:20px;
    border-radius:10px;
    margin-bottom:20px;
}

.user-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.user-info{
    display:flex;
    gap:15px;
}

.label{
    font-size:12px;
    color:#555;
}

.box{
    background:#1E3A8A;
    color:white;
    padding:8px 12px;
    border-radius:8px;
    font-size:14px;
}

.address-box{
    background:white;
    padding:12px;
    border-radius:10px;
    margin-top:10px;
    font-size:14px;
}

.delete-btn{
    font-size:20px;
    background:none;
    border:none;
    cursor:pointer;
}

</style>

@foreach($users as $u)

<div class="user-card">

    <!-- ATAS: NAMA + EMAIL + HAPUS -->
    <div class="user-top">

        <div class="user-info">
            <div>
                <div class="label">Nama</div>
                <div class="box">{{ $u->name }}</div>
            </div>

            <div>
                <div class="label">Email</div>
                <div class="box">{{ $u->email }}</div>
            </div>
        </div>

        <!-- Tombol hapus -->
        <a href="{{ route('admin.user.delete', $u->id) }}"
           onclick="return confirm('Yakin mau hapus user ini?')">

            <button class="delete-btn">🗑</button>

        </a>

    </div>

    <!-- BAWAH: ALAMAT -->
    <div>
        <div class="label">Alamat</div>
        <div class="address-box">
            {{ $u->alamat ?? 'Belum diisi' }}
        </div>
    </div>

</div>

@endforeach

@endsection