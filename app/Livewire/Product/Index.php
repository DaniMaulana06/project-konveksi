<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::query()
            ->when(
                $this->search,
                fn($query) =>
                $query->where('nama_produk', 'like', '%' . $this->search . '%')
            )->latest()->paginate(10);
        return view('livewire.product.index', compact('products'));
    }
}
