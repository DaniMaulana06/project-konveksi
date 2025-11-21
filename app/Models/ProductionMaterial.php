<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionMaterial extends Model
{
    protected $table = 'production_material';
    protected $fillable = [
        'nama_bahan',
        'stok_tersedia',
        'satuan',
        'harga_per_unit',
    ];
}
