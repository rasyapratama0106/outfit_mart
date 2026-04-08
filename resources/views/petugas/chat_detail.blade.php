@extends('layouts.petugas')

@section('title','Chat Detail')

@section('content')

<div style="background:white; border-radius:10px; overflow:hidden;">

    <!-- HEADER -->
    <div style="background:#1E3A8A; color:white; padding:15px; display:flex; align-items:center; gap:10px;">
        <img src="{{ asset('images/outfitmart.png') }}" style="width:40px; height:40px; border-radius:50%;">
        <div>
            <strong>{{ $user->name }}</strong><br>
            <small>Customer</small>
        </div>
    </div>

    <!-- CHAT -->
    <div style="height:350px; overflow:auto; padding:15px; background:#f1f5f9;">

        @foreach($chats as $chat)

            @if($chat->sender == 'petugas')
                <div style="text-align:right; margin-bottom:10px;">
                    <div style="display:inline-block; background:#1E3A8A; color:white; padding:10px; border-radius:10px;">
                        {{ $chat->message }}
                    </div>
                </div>
            @else
                <div style="margin-bottom:10px;">
                    <div style="display:inline-block; background:white; padding:10px; border-radius:10px;">
                        {{ $chat->message }}
                    </div>
                </div>
            @endif

        @endforeach

    </div>

    <!-- INPUT -->
    <form method="POST" action="/petugas/chat/send" style="display:flex;">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <input type="text" name="message" placeholder="Ketik pesan..."
               style="flex:1; padding:10px; border:none; outline:none;">

        <button style="background:#1E3A8A; color:white; border:none; padding:10px 20px;">
            Kirim
        </button>
    </form>

</div>

@endsection