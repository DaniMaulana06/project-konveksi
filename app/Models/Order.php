<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'nama_order',
        'nama_customer',
        'no_telp',
        'asal_instansi',
        'jumlah_order',
        'file_panduan',
        'keterangan',
        'harga_total',
        'status_order',
        'created_by',
        'product_id'
    ];

    // Relasi ke Produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke User (yang membuat order)
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function materialProduction()
    {
        return $this->hasMany(ProductionMaterial::class);
    }

    // Relasi ke kebutuhan bahan produksi
    public function material()
    {
        return $this->hasMany(OrderMaterial::class);
    }

    protected static function booted()
    {
        // Yang sudah ada (jangan dihapus)
        static::creating(function ($order) {
            if (auth()->check()) {
                $order->created_by = auth()->id();
            }
        });
        
        // isi otomatis aktivitas ketika order dibuat
        static::created(function ($order) {
            \App\Models\Aktivitas::catat(
                jenis: 'order',
                judul: 'Order Baru Dibuat',
                deskripsi: "Order #{$order->id} - {$order->nama_order} dari {$order->nama_customer}",
                icon: 'fa-shopping-cart',
                warna: 'success',
                reference: $order
            );
        });

        // isi otomatis aktivitas ketika order diupdate
        static::updated(function ($order) {
            // Cek apakah status_order yang berubah
            if ($order->isDirty('status_order')) {
                $statusText = [
                    'pending' => 'Menunggu Konfirmasi',
                    'proses' => 'Sedang Diproses',
                    'selesai' => 'Selesai',
                    'dikirim' => 'Sedang Dikirim'
                ];

                $warna = [
                    'pending' => 'warning',
                    'proses' => 'info',
                    'selesai' => 'success',
                    'dikirim' => 'primary'
                ];

                $status = $order->status_order;

                \App\Models\Aktivitas::catat(
                    jenis: 'order',
                    judul: 'Status Order Diubah',
                    deskripsi: "Order #{$order->id} - {$statusText[$status]}",
                    icon: 'fa-sync-alt',
                    warna: $warna[$status] ?? 'info',
                    reference: $order
                );
            }
        });
    }

    public function productionMaterials()
    {
        return $this->hasMany(\App\Models\ProductionMaterial::class, 'production_list_id');
    }

    public function productionList()
    {
        return $this->hasOne(\App\Models\ProductionListModel::class, 'order_id');
    }
}