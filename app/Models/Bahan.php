<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = 'material';
    protected $fillable = [
        'nama_bahan', 
        'satuan', 
        'stok'
    ];

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
}
