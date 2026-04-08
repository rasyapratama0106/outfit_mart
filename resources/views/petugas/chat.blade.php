@extends('layouts.petugas')

@section('title','Chat User')

@section('content')

<h2>Chat Customer</h2>

<div style="background:white; padding:20px; border-radius:10px;">

@foreach($users as $user)

<a href="/petugas/chat/{{ $user->id }}" style="text-decoration:none; color:black;">
    
    <div style="
        display:flex;
        align-items:center;
        gap:15px;
        padding:15px;
        border-bottom:1px solid #ddd;
    ">

        <img src="{{ asset('images/outfitmart.png') }}"
             style="width:50px; height:50px; border-radius:50%;">

        <div>
            <strong>{{ $user->name }}</strong><br>
            <small style="color:gray;">Klik untuk chat</small>
        </div>

    </div>

</a>

@endforeach

</div>

@endsection