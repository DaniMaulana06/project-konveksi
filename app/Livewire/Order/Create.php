<?php

namespace App\Livewire\Order;

use App\Livewire\Production\ProductionList;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductionListModel;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Rule('required|date')]
    public $tgl_order;

    #[Rule('required|string|max:50',message: 'Nama tidak boleh lebih dari 5 karakter')]
    public $nama_customer;
    #[Rule('required|string|max:12')]
    public $no_telp;
    #[Rule('string|max:100')]
    public $asal_instansi;
    #[Rule('required|integer|min:1')]
    public $jumlah_order;
    #[Rule('required|numeric|min:0|decimal:0,2')]
    public $harga_total;

    #[Rule('required|file|mimes:pdf,docx|max:2048')]
    public $file_panduan;

    #[Rule('required|exists:product,id')]
    public $product_id;

    public function store()
    {
        $validatedData = $this->validate();

        // Ambil produk berdasarkan product_id
        $product = Product::findOrFail($this->product_id);

        // Store the uploaded file and get the path
        $filePath = $this->file_panduan->store('panduan_files', 'public');

        // Save the order data to the database
        $order = Order::create([
            'tgl_order' => $validatedData['tgl_order'],
            'product_id' => $product->id,
            'nama_customer' => $validatedData['nama_customer'],
            'no_telp' => $validatedData['no_telp'],
            'asal_instansi' => $validatedData['asal_instansi'],
            'jumlah_order' => $validatedData['jumlah_order'],
            'harga_total' => $validatedData['harga_total'],
            'file_panduan' => $filePath,
        ]);

        $pl = ProductionListModel::create([
            'order_id' => $order->id,
        ]);
        

        // Provide feedback to the user
        session()->flash('message', 'Order berhasil disimpan dengan produk: ' . $product->nama_produk);
        return redirect()->route('order.index');
    }

    public function render()
    {
        $products = Product::all(); 
        return view('livewire.order.create', compact('products'));
    }
}
