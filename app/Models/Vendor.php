<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Livewire\WithPagination;

class Vendor extends Model
{
    use WithPagination;
    protected $table = 'vendor';
    protected $fillable = [
        'nama_vendor',
        'barang_vendor',
        'alamat_vendor',
        'no_vendor'
    ];
}
