<?php

namespace App\Livewire\Owner;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OwnerOrder extends Component
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
                    ->orWhere('status_order', 'like', '%' . $this->search . '%')
            )
            ->latest()
            ->paginate(10);

        return view('livewire.owner.order', compact('orders'));
    }
}
