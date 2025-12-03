<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use function PHPUnit\Framework\returnArgument;

class Detail extends Component
{
    public function terimaOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->status_order = 'selesai';
        $order->save();

        session()->flash('success', 'Order berhasil diterima.');
        return redirect()->route('order.detail', ['id' => $id]);
    }
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
