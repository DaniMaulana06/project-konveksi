<?php

namespace App\Livewire\Production;

use App\Models\OrderDetail;
use App\Models\OrderMaterial;
use Livewire\Component;

class OrderDetailCreate extends Component
{
    public $orderId;
    public $size;
    public $jumlah;
    public $harga_satuan;
    public $total_harga;

    public function saveDetail(){
        OrderDetail::create([
            'order_id' => $this->orderId,
            'jumlah' => $this->jumlah,
            'harga_satuan' => $this->harga_satuan,
            'total_harga' => $this->total_harga,
        ]);

        session()->flash('message', 'Order detail berhasil ditambahkan.');
    }

    public function saveMaterial(){
        OrderMaterial::create([
            'order_id' => $this->orderId,
            'quantity_require' => $this->quantity_require,
            'unit' => $this->unit,
        ]);
        session()->flash('message', 'kebutuhan bahan produksi berhasil ditambahkan.');
    }
    public function render()
    {
        return view('livewire.production.order-detail-create');
    }
}
