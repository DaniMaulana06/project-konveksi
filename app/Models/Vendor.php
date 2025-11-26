<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendor';
    protected $fillable = [
        'nama_vendor',
        'barang_vendor',
        'alamat_vendor',
        'no_vendor'
    ];
}
