<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMaterial extends Model
{
    protected $table = 'order_material';
    protected $fillable = [
        'order_id',
        'material_id',
        'quantity_required',
        'unit',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function material()
    {
        return $this->belongsTo(Bahan::class);
    }
}
