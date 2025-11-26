<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Edit extends Component
{
    #[Rule('required|string|max:50')]
    public $nama_kategori;
    #[Rule('nullable|string|max:50')]
    public $deskripsi;

    public function mount($id) {
        $category = Category::find($id);

        if (!$category) {
            abort(404);
        }

        // Isi ke form
        $this->nama_kategori = $category->nama_kategori;
        $this->deskripsi     = $category->deskripsi;
    }

    public function update() {
        $validated = $this->validate();

        $category = Category::where('nama_kategori', $this->nama_kategori)->first();

        if (!$category) {
            session()->flash('error', 'Data tidak ditemukan');
            return;
        }

        $category->update($validated);

        session()->flash('message', 'Data kategori berhasil diperbarui');
        return redirect()->route('category.index');
    }
    public function render()
    {
        return view('livewire.category.edit');
    }
}
