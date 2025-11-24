<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'nama_customer',
        'no_telp',
        'asal_instansi',
        'jumlah_order',
        'file_panduan',
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
        static::creating(function ($order) {
            if (auth()->check()) {
                $order->created_by = auth()->id();
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
