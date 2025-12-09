<?php

namespace App\Livewire\Owner;

use App\Models\Order;
use Livewire\Component;

class Detailorder extends Component
{
    public function render()
    {
        $order_detail = Order::where('id', request()->route('id'))->get(); // Menggunakan get() untuk memastikan hasil selalu berupa koleksi

        if ($order_detail->isEmpty()) {
            session()->flash('error', 'Order tidak ditemukan.');
            return redirect()->route('order.index');
        }

        return view('livewire.owner.detailorder', compact('order_detail'));
    }
}
