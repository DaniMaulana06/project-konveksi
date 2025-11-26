<?php

namespace App\Livewire\Bahan;

use App\Models\Bahan;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $bahan_id;

    #[Rule('required|string|max:50')]
    public $nama_bahan;

    #[Rule('required|string|in:meter,kilogram,lembar,buah,roll,pcs')]
    public $satuan;

    #[Rule('required|numeric')]
    public $stok;

    public function mount($id)
    {
        $bahan = Bahan::find($id);

        if (!$bahan) {
            abort(404);
        }

        // Isi ke form
        $this->bahan_id   = $bahan->id;
        $this->nama_bahan = $bahan->nama_bahan;
        $this->satuan     = $bahan->satuan;
        $this->stok       = $bahan->stok;
    }

    public function update()
    {
        $validated = $this->validate();

        $bahan = Bahan::find($this->bahan_id);

        if (!$bahan) {
            session()->flash('error', 'Data tidak ditemukan');
            return;
        }

        $bahan->update($validated);

        session()->flash('message', 'Data bahan berhasil diperbarui');
        return redirect()->route('bahan.index');
    }

    public function render()
    {
        return view('livewire.bahan.edit', [
            'bahan' => Bahan::all()
        ]);
    }
}
