<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    #[Rule('required|string|max:50')]
    public $nama_kategori;
    #[Rule('nullable|string|max:100')]
    public $deskripsi;

    public function store(){
        $validateData = $this->validate();

        $category = Category::create([
            'nama_kategori' => $validateData['nama_kategori'],
            'deskripsi' => $validateData['deskripsi'],
        ]);

        session()->flash('message', 'Kategori berhasil ditambahkan: ' . $category->nama_kategori);
        redirect()->route('category.index');
    }
    public function render()
    {
        return view('livewire.category.create');
    }
}
