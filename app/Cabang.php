<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'alamat', 'nama', 'deskripsi'
    ];

}
