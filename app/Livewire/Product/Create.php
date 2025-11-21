<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Rule('required|string|max:100')]
    public $nama_produk;
    #[Rule('required|string|in:jersey,kemeja,idcard,topi')]
    public $kategori_produk;
    #[Rule('required|string|max:50')]
    public $deskripsi_produk;
    #[Rule('required|file|max:250')]
    public $gambar;

    public function store()
    {
        $validatedData = $this->validate();
        $filePath = $this->gambar->store('gambar_produk', 'public');

        Product::create([
            'nama_produk' => $validatedData['nama_produk'],
            'kategori_produk' => $validatedData['kategori_produk'],
            'deskripsi_produk' => $validatedData['deskripsi_produk'],
            'gambar' => $filePath,
        ]);

        session()->flash('message', 'Produk berhasil ditambahkan!');
        return redirect()->route('product.index');
    }

    public function render()
    {
        $products = Product::all();
        return view('livewire.product.create', compact('products'));
    }
}
