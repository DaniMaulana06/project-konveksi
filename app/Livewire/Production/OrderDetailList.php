<?php

namespace App\Livewire\Production;

use App\Models\Order;
use Livewire\Component;

class OrderDetailList extends Component
{
    public $orderId;
    protected $listeners = ['update-status-final' => 'updateStatus'];


    public function mount($orderId)
    {
        $this->orderId = $orderId;
    }

    public function updateStatus($status)
    {
        $order = Order::with('product')->findOrFail($this->orderId);

        $order->update([
            'status_order' => $status
        ]);

        session()->flash('message', 'Status berhasil diperbarui!');
    }

    public function render()
    {
        $order = Order::with([
            'product',
            'productionList.materials.material'
        ])->findOrFail($this->orderId);

        return view('livewire.production.order-detail-list', [
            'order' => $order,
        ]);
    }
}
