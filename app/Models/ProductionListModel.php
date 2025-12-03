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

    public function materials()
    {
        return $this->hasMany(\App\Models\ProductionMaterial::class, 'production_list_id');
    }

    protected static function booted()
    {
        // Saat produksi dibuat (production list baru)
        static::created(function ($production) {
            \App\Models\Aktivitas::catat(
                jenis: 'produksi',
                judul: 'Proses Produksi Dimulai',
                deskripsi: "Produksi untuk Order #{$production->order_id}",
                icon: 'fa-industry',
                warna: 'primary',
                reference: $production
            );
        });

        // Saat status produksi diubah
        static::updated(function ($production) {
            // Cek apakah status_produksi yang berubah
            if ($production->isDirty('status_produksi')) {
                $statusText = [
                    'pending' => 'Menunggu',
                    'proses' => 'Sedang Dikerjakan',
                    'selesai' => 'Selesai'
                ];

                $warna = [
                    'pending' => 'warning',
                    'proses' => 'info',
                    'selesai' => 'success'
                ];

                $status = $production->status_produksi;

                \App\Models\Aktivitas::catat(
                    jenis: 'produksi',
                    judul: 'Status Produksi Diubah',
                    deskripsi: "Produksi Order #{$production->order_id} - {$statusText[$status]}",
                    icon: 'fa-check-circle',
                    warna: $warna[$status] ?? 'info',
                    reference: $production
                );
            }
        });
    }
}