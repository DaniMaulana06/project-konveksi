<?php

namespace App\Livewire\Production;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class ProductionList extends Component
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
        $orders = Order::query()
        ->when(
            $this->search,
            fn($query) =>
            $query->where('nama_order', 'like', '%' . $this->search . '%')
                ->orWhere('nama_customer', 'like', '%' . $this->search . '%')
        )->latest()->paginate(10);

        return view('livewire.production.production-list', compact('orders'));
    }
}
