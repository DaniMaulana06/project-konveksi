<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $fillable = [
        'order_id', 
        'product_id',
        'jumlah', 
        'harga_satuan', 
        'keterangan',
        'total_harga'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function material(){
        return $this->belongsTo(Bahan::class);
    }

    public function added(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
