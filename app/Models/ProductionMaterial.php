<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionMaterial extends Model
{
    protected $table = 'production_material';
    protected $fillable = [
        'production_list_id',
        'material_id',
        'jumlah',
        'nama_bahan',
        'stok_tersedia',
        'satuan',
        'harga_per_unit',
    ];

    // Relasi ke tabel material
    public function material()
    {
        return $this->belongsTo(Bahan::class, 'material_id');
    }

    // Relasi ke tabel production_list
    public function productionList()
    {
        return $this->belongsTo(ProductionListModel::class, 'production_list_id');
    }
}
