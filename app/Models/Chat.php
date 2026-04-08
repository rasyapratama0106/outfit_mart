<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';

    protected $fillable = [
        'user_id',
        'petugas_id',
        'sender',
        'message'
    ];

    public $timestamps = false; // karena kita pakai created_at manual
}