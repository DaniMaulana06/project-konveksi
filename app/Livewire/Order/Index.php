<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;

class Index extends Component
{
    public function destroy($id) {
        Order::destroy($id);
        session()->flash('message', 'Order deleted successfully.');
        return redirect()->route('order.index');
    }
    public function render()
    {
        $orders = Order::with('product')
        ->where('created_by', auth()->id())
        ->latest()
        ->get();
        
        return view('livewire.order.index', compact('orders'));
    }
}
