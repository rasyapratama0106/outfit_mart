<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat'
    ];

    protected $hidden = [
        'password'
    ];
}