<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nama', 'deskripsi', 'harga','tmp','gambar','kategori'
    ];

}
