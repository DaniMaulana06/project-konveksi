<?php

namespace App\Livewire\Vendor;

use App\Models\Vendor;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    #[Rule('required|string|max:50')]
    public $nama_vendor;
    #[Rule('required|string|max:50')]
    public $barang_vendor;
    #[Rule('required|string|max:500')]
    public $alamat_vendor;
    #[Rule('required|numeric|min:10')]
    public $no_vendor;

    public function store()
    {
        $validateData = $this->validate();
        Vendor::create([
            'nama_vendor' => $validateData['nama_vendor'],
            'barang_vendor' => $validateData['barang_vendor'],
            'alamat_vendor' => $validateData['alamat_vendor'],
            'no_vendor' => $validateData['no_vendor'],
        ]);

        session()->flash('message', 'Vendor berhasil ditambahkan.');

        return redirect()->route('vendor.index');
    }
    public function render()
    {
        return view('livewire.vendor.create');
    }
}
