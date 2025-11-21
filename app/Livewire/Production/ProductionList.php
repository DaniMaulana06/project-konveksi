<?php

namespace App\Livewire\Production;

use App\Models\Order;
use Livewire\Component;

class ProductionList extends Component
{
    public function render()
    {
        $orders = Order::with('product')->latest()->get();

        return view('livewire.production.production-list', compact('orders'));
    }
}
