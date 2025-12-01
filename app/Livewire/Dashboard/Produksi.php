<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Order;
use App\Models\Bahan;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Produksi extends Component
{
    public $totalOrder;
    public $orderPending;
    public $orderProses;
    public $orderDikirim;
    public $orderSelesai;
    
    // Statistik Bahan
    public $totalMaterials;
    public $lowStock;
    
    // Top Produk yang Sering Diproduksi
    public $topProducts;
    
    public function mount()
    {
        // Inisialisasi default values
        $this->topProducts = [];
        
        // Data Order
        $this->totalOrder   = Order::count();
        $this->orderPending = Order::where('status_order', 'pending')->count();
        $this->orderProses  = Order::where('status_order', 'proses')->count();
        $this->orderDikirim = Order::where('status_order', 'dikirim')->count();
        $this->orderSelesai = Order::where('status_order', 'selesai')->count();
        
        // Data Bahan
        $this->totalMaterials = Bahan::count();
        $this->lowStock = Bahan::where('stok', '<', 20)->count();
        
        // Load Top Products
        $this->loadTopProducts();
    }
    
    public function loadTopProducts()
    {
        try {
            // Cek apakah ada data order
            if (Order::count() == 0) {
                $this->topProducts = [];
                return;
            }

            // Ambil top 5 produk berdasarkan jumlah order dan total quantity
            $products = Order::select(
                    'product.id',
                    'product.nama_produk',
                    'categories.nama_kategori as kategori',
                    DB::raw('COUNT(DISTINCT order.id) as total_orders'),
                    DB::raw('SUM(order.jumlah_order) as total_quantity')
                )
                ->join('product', 'order.product_id', '=', 'product.id')
                ->leftJoin('categories', 'product.category_id', '=', 'categories.id')
                ->whereNotNull('order.product_id')
                ->groupBy('product.id', 'product.nama_produk', 'categories.nama_kategori')
                ->orderByDesc('total_quantity')
                ->orderByDesc('total_orders')
                ->limit(5)
                ->get();

            $this->topProducts = $products->map(function($item) {
                return [
                    'id' => $item->id,
                    'nama_produk' => $item->nama_produk,
                    'kategori' => $item->kategori ?? 'Uncategorized',
                    'total_orders' => $item->total_orders ?? 0,
                    'total_quantity' => $item->total_quantity ?? 0
                ];
            })->toArray();

        } catch (\Exception $e) {
            // Jika terjadi error, set ke array kosong
            $this->topProducts = [];
            Log::error('Error loading top products: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.dashboard.produksi');
    }
}