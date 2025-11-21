<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;

class Detail extends Component
{
    public function render()
    {
        $order_detail = Order::where('id', request()->route('id'))->get(); // Menggunakan get() untuk memastikan hasil selalu berupa koleksi

        if ($order_detail->isEmpty()) {
            session()->flash('error', 'Order tidak ditemukan.');
            return redirect()->route('order.index');
        }

        return view('livewire.order.detail', compact('order_detail'));
    }
}
