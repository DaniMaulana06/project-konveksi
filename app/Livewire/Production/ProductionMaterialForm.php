<?php

namespace App\Livewire\Production;

use App\Models\Bahan;
use App\Models\ProductionListModel;
use Livewire\Component;
use App\Models\ProductionMaterial;

class ProductionMaterialForm extends Component
{
    public $production_list_id;
    public $materials = [];
    public $inputs = [];

    public function mount($orderId)
    {
        $production = ProductionListModel::where('order_id', $orderId)->first();

        $this->production_list_id = $production->id;   // ✔ BENAR — ini FK valid

        $this->materials = Bahan::all();

        $this->inputs[] = [
            'material_id' => '',
            'stok' => '',
            'jumlah' => '',
            'keterangan' => '',
        ];
    }


    public function updatedInputs($value, $key)
    {

        $parts = explode('.', $key);

        if (count($parts) !== 2) {
            return;
        }

        $index = $parts[0];
        $field = $parts[1];

        if ($field === "material_id") {

            $material = Bahan::find($value);

            if ($material) {
                $this->inputs[$index]['stok'] = $material->stok;
            } else {
                $this->inputs[$index]['stok'] = '';
            }
        }
    }

    public function addInput()
    {
        $this->inputs[] = [
            'material_id' => '',
            'stok' => '',
            'jumlah' => '',
            'keterangan' => '',
        ];
    }

    public function removeInput($i)
    {
        unset($this->inputs[$i]);
        $this->inputs = array_values($this->inputs);
    }

    public function save()
    {
        foreach ($this->inputs as $inp) {

            if (!$inp['material_id'] || !$inp['jumlah']) {
                continue;
            }

            $material = Bahan::find($inp['material_id']);

            if ($inp['jumlah'] > $material->stok) {
                session()->flash('error', "Jumlah bahan '{$material->nama_bahan}' melebihi stok tersedia ({$material->stok}).");
                return;
            }

            ProductionMaterial::create([
                'production_list_id' => $this->production_list_id,
                'material_id' => $inp['material_id'],
                'jumlah' => $inp['jumlah'],
                'keterangan' => $inp['keterangan'],
            ]);

            // Update stok
            $material = Bahan::find($inp['material_id']);
            $material->stok -= $inp['jumlah'];
            $material->save();
        }

        session()->flash('message', 'Semua bahan berhasil disimpan.');
        return redirect()->route('production.material.list');
    }

    public function render()
    {
        return view('livewire.production.production-material-form', [
            'materials' => Bahan::all()
        ]);
    }
}
