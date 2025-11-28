<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Pest\Mutate\Mutators\Math\CeilToFloor;

class Edit extends Component
{
    use WithFileUploads;

    public $product_id;

    #[Rule('required|string|max:100')]
    public $nama_produk;

    #[Rule('required|exists:categories,id')]
    public $category_id;

    #[Rule('required|string|max:50')]
    public $deskripsi_produk;

    // Gambar baru
    #[Rule('nullable|file|max:250')]
    public $gambar_baru;

    // Menampilkan gambar lama
    public $gambar_lama;

    public function mount($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $id;

        $this->nama_produk = $product->nama_produk;
        $this->category_id = $product->category_id;
        $this->deskripsi_produk = $product->deskripsi_produk;
        $this->gambar_lama = $product->gambar;
    }

    public function update()
    {
        $this->validate();

        $product = Product::findOrFail($this->product_id);

        // Jika ada upload gambar baru
        if ($this->gambar_baru) {

            // Hapus gambar lama jika ada dan file benar-benar ada
            if ($product->gambar && Storage::disk('public')->exists($product->gambar)) {
                Storage::disk('public')->delete($product->gambar);
            }

            // Simpan gambar baru
            $gambarPath = $this->gambar_baru->store('gambar_produk', 'public');

        } else {
            // Jika tidak upload gambar baru → tetap pakai gambar lama
            $gambarPath = $product->gambar;
        }

        $product->update([
            'nama_produk' => $this->nama_produk,
            'category_id' => $this->category_id,
            'deskripsi_produk' => $this->deskripsi_produk,
            'gambar' => $gambarPath,
        ]);

        session()->flash('message', 'Produk berhasil diperbarui!');
        return redirect()->route('product.index');
    }

    public function render()
    {
        return view('livewire.product.edit', [
            'categories' => Category::all()
        ]);
    }
}
