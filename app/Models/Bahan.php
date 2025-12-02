<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Livewire\WithPagination;

class Bahan extends Model
{
    use WithPagination;
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
