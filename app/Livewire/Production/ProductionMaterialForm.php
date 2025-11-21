<?php

namespace App\Livewire\Production;

use App\Models\Bahan;
use App\Models\OrderMaterial;
use App\Models\ProductionMaterial;
use Livewire\Component;

class ProductionMaterialForm extends Component
{
    public $production_list_id;

    public $material_id;
    public $stok_awal;
    public $satuan;
    public $jumlah;
    public $keterangan;

    public $materials = [];

    public function mount($orderId)
    {
        $this->production_list_id = $orderId;

        // Ambil list bahan dari tabel material
        $this->materials = Bahan::all();
    }

    // Update otomatis saat memilih material
    public function updatedMaterialId($value)
    {
        $material = Bahan::find($value);

        if ($material) {
            $this->stok_awal = $material->stok;
            $this->satuan    = $material->satuan;
        }
    }

    public function save()
    {
        $this->validate([
            'material_id' => 'required|exists:material,id',
            'jumlah'      => 'required|integer|min:1',
            'keterangan'  => 'nullable|string',
        ]);

        ProductionMaterial::create([
            'production_list_id' => $this->production_list_id,
            'material_id'        => $this->material_id,
            'jumlah'             => $this->jumlah,
            'keterangan'         => $this->keterangan,
        ]);

        // Optional: Kurangi stok material
        $material = Bahan::find($this->material_id);
        $material->stok -= $this->jumlah;
        $material->save();

        session()->flash('success', 'Bahan produksi berhasil ditambahkan.');

        // Reset form
        $this->reset(['material_id', 'stok_awal', 'satuan', 'jumlah', 'keterangan']);
    }
    public function render()
    {
        return view('livewire.production.production-material-form');
    }
}
