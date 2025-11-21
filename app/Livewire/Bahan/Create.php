<?php

namespace App\Livewire\Bahan;

use App\Models\Bahan;
use App\Models\Material;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    #[Rule('required|string|max:50')]
    public $nama_bahan;
    #[Rule('required|string|in:meter,kilogram,lembar,buah,roll')]
    public $satuan;
    #[Rule('required')]
    public $stok;

    public $id; // Declare the $id property
    public function store() {
        $validateData = $this->validate();

        $bahan = Bahan::create([
            'nama_bahan' => $validateData['nama_bahan'],
            'satuan' => $validateData['satuan'],
            'stok' => $validateData['stok'],
        ]);

        session()->flash('message', 'Bahan berhasil ditambahkan: ' . $bahan->nama_bahan);
        return redirect()->route('bahan.index');
    }
    public function render()
    {
        $bahan = Bahan::all();
        return view('livewire.bahan.create', compact('bahan'));
    }
}
