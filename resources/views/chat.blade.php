@extends('layouts.app')

@section('content')

<style>
.chat-box{
    height:400px;
    overflow:auto;
    background:#e3f2fd;
    padding:15px;
    border-radius:10px;
}

.msg{
    display:flex;
    margin-bottom:10px;
}

.msg.user{
    justify-content:flex-end;
}

.bubble{
    padding:10px 15px;
    border-radius:15px;
    max-width:70%;
}

.user .bubble{
    background:#1E3A8A;
    color:white;
}

.petugas .bubble{
    background:white;
}

.header-chat{
    display:flex;
    align-items:center;
    gap:10px;
    background:#1E3A8A;
    color:white;
    padding:10px;
    border-radius:10px;
    margin-bottom:10px;
}

.header-chat img{
    width:40px;
    height:40px;
    border-radius:50%;
}
</style>

<!-- HEADER -->
<div class="header-chat">
    <img src="{{ asset('images/outfitmart.png') }}">
    <div>
        <b>OutfitMart</b><br>
        <small>Online</small>
    </div>
</div>

<!-- CHAT -->
<div class="chat-box">

@foreach($chats as $chat)

    @if($chat->sender == 'user')
    <div class="msg user">
        <div class="bubble">
            {{ $chat->message }}
        </div>
    </div>
    @else
    <div class="msg petugas">
        <div class="bubble">
            {{ $chat->message }}
        </div>
    </div>
    @endif

@endforeach

</div>

<!-- INPUT -->
<form method="POST" action="{{ route('chat.send') }}" style="display:flex; gap:10px; margin-top:10px;">
    @csrf
    <input type="text" name="message" placeholder="Ketik pesan..."
        style="flex:1; padding:10px; border-radius:10px;">
    <button style="background:#1E3A8A; color:white; border:none; padding:10px 20px; border-radius:10px;">
        Kirim
    </button>
</form>

@endsection