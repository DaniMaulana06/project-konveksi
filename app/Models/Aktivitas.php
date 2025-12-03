<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    protected $table = 'aktivitas';

    protected $fillable = [
        'jenis',
        'judul',
        'deskripsi',
        'icon',
        'warna',
        'reference_id',
        'reference_type',
        'user_id'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Polymorphic relation ke model apapun
    public function reference()
    {
        return $this->morphTo();
    }

    // Helper untuk mencatat aktivitas
    public static function catat($jenis, $judul, $deskripsi = null, $icon = 'fa-bell', $warna = 'primary', $reference = null)
    {
        $data = [
            'jenis' => $jenis,
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'icon' => $icon,
            'warna' => $warna,
            'user_id' => auth()->id()
        ];

        // Jika ada reference (misal: Order, Product, dll)
        if ($reference) {
            $data['reference_id'] = $reference->id;
            $data['reference_type'] = get_class($reference);
        }

        return self::create($data);
    }
}