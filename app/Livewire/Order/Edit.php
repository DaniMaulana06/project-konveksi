<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $orderId;
    public $product_id;
    public $nama_order;
    public $nama_customer;
    public $no_telp;
    public $asal_instansi;
    public $harga_total;
    public $file_panduan_lama;
    public $file_panduan;
    public $jumlah_order;
    public $keterangan;
    public $order;

    public function mount($id)
    {
        $this->order = Order::findOrFail($id);
        $this->nama_order = $this->order->nama_customer;
        $this->nama_customer   = $this->order->nama_customer;
        $this->no_telp         = $this->order->no_telp;
        $this->asal_instansi   = $this->order->asal_instansi;
        $this->jumlah_order    = $this->order->jumlah_order;
        $this->keterangan      = $this->order->keterangan;
        $this->harga_total     = $this->order->harga_total;
        $this->product_id      = $this->order->product_id;

        // file lama disimpan ke variabel
        $this->file_panduan_lama = $this->order->file_panduan;
    }


    public function update()
    {
        $validated = $this->validate([
            'nama_order' => 'required|max:50',
            'nama_customer' => 'required|max:50',
            'no_telp' => 'required|max:12',
            'asal_instansi' => 'nullable|max:100',
            'jumlah_order' => 'required|integer|min:1',
            'keterangan' => 'nullable|max:255',
            'harga_total' => 'required|numeric',
            'product_id' => 'required|exists:product,id',
            'file_panduan' => 'nullable|file|mimes:pdf,docx|max:2048',
        ]);

        // Jika upload file baru
        if ($this->file_panduan) {
            $path = $this->file_panduan->store('panduan_files', 'public');
            $validated['file_panduan'] = $path;
        } else {
            // Jika tidak upload file, pakai file lama
            $validated['file_panduan'] = $this->file_panduan_lama;
        }

        // Update database
        $this->order->update($validated);

        session()->flash('message', 'Order berhasil diperbarui!');
        return redirect()->route('order.index');
    }


    public function render()
    {
        return view('livewire.order.edit', [
            'products' => Product::all(),
        ]);
    }
}
