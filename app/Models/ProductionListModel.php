<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionListModel extends Model
{
    protected $table = 'production_list';
    protected $fillable = ['order_id', 'status_produksi'];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
