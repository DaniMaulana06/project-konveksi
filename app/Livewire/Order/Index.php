<?php

namespace App\Livewire\Order;

use App\Models\Order;
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
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status_order == 'selesai' || $order->status_order == 'dikirim') {
            session()->flash('error', 'Order sudah ' . $order->status_order . ', tidak dapat dihapus.');
            return redirect()->route('order.index');
        }
        $order->delete();

        session()->flash('message', 'Order deleted successfully.');
        return redirect()->route('order.index');

    }
    public function render()
    {
        $orders = Order::with([
            'product.category', // ← eager loading
            'product'
        ])->when(
                $this->search,
                fn($query) =>
                $query->where('nama_order', 'like', '%' . $this->search . '%')
                    ->orWhere('nama_customer', 'like', '%' . $this->search . '%')
                    ->orWhere('status_order', 'like', '%' . $this->search . '%')
            )->where('created_by', auth()->id())
            ->latest()
            ->paginate(10);

        return view('livewire.order.index', compact('orders'));
    }
}
