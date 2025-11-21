<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'nama_produk',
        'kategori_produk',
        'deskripsi_produk',
        'gambar',
    ];

    // Relasi ke Order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
