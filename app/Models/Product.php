<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'nama_produk',
        'category_id',
        'deskripsi_produk',
        'gambar',
    ];

    // Relasi ke Order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // ===== TAMBAHKAN METHOD BARU INI =====
    protected static function booted()
    {
        // Saat produk baru ditambahkan
        static::created(function ($product) {
            \App\Models\Aktivitas::catat(
                jenis: 'produk',
                judul: 'Produk Baru Ditambahkan',
                deskripsi: "Produk: {$product->nama_produk}",
                icon: 'fa-box',
                warna: 'success',
                reference: $product
            );
        });

        // Saat produk diupdate
        static::updated(function ($product) {
            \App\Models\Aktivitas::catat(
                jenis: 'produk',
                judul: 'Produk Diperbarui',
                deskripsi: "Produk: {$product->nama_produk} telah diperbarui",
                icon: 'fa-edit',
                warna: 'info',
                reference: $product
            );
        });

        // Saat produk dihapus
        static::deleted(function ($product) {
            \App\Models\Aktivitas::catat(
                jenis: 'produk',
                judul: 'Produk Dihapus',
                deskripsi: "Produk: {$product->nama_produk} telah dihapus",
                icon: 'fa-trash',
                warna: 'danger'
            );
        });
    }
    // ===== AKHIR KODE BARU =====
}