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
    protected static function booted()
    {
        // Saat bahan baru ditambahkan
        static::created(function ($bahan) {
            \App\Models\Aktivitas::catat(
                jenis: 'bahan',
                judul: 'Bahan Baru Ditambahkan',
                deskripsi: "Bahan: {$bahan->nama_bahan} - Stok: {$bahan->stok} {$bahan->satuan}",
                icon: 'fa-cubes',
                warna: 'success',
                reference: $bahan
            );
        });

        // Saat bahan diupdate
        static::updated(function ($bahan) {
            // Cek apakah stok yang berubah
            if ($bahan->isDirty('stok')) {
                $stokLama = $bahan->getOriginal('stok');
                $stokBaru = $bahan->stok;
                $selisih = $stokBaru - $stokLama;
                
                if ($selisih > 0) {
                    // Stok bertambah
                    \App\Models\Aktivitas::catat(
                        jenis: 'bahan',
                        judul: 'Stok Bahan Bertambah',
                        deskripsi: "Bahan: {$bahan->nama_bahan} bertambah {$selisih} {$bahan->satuan} (dari {$stokLama} menjadi {$stokBaru})",
                        icon: 'fa-arrow-up',
                        warna: 'success',
                        reference: $bahan
                    );
                } else {
                    // Stok berkurang
                    \App\Models\Aktivitas::catat(
                        jenis: 'bahan',
                        judul: 'Stok Bahan Berkurang',
                        deskripsi: "Bahan: {$bahan->nama_bahan} berkurang " . abs($selisih) . " {$bahan->satuan} (dari {$stokLama} menjadi {$stokBaru})",
                        icon: 'fa-arrow-down',
                        warna: 'warning',
                        reference: $bahan
                    );
                }
            }
        });

        // Saat bahan dihapus
        static::deleted(function ($bahan) {
            \App\Models\Aktivitas::catat(
                jenis: 'bahan',
                judul: 'Bahan Dihapus',
                deskripsi: "Bahan: {$bahan->nama_bahan} telah dihapus dari sistem",
                icon: 'fa-trash',
                warna: 'danger'
            );
        });
    }
}