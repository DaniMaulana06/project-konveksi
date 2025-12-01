<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Order;
use App\Models\Aktivitas;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class Admin extends Component
{
    public $totalOrder = 0;
    public $orderPending = 0;
    public $orderProses = 0;
    public $orderSelesai = 0;
    public $aktivitasTerbaru = [];
    public $lastAktivitasId = 0;
    
    // Data untuk grafik
    public $monthlyOrderData = [];
    public $monthlyLabels = [];
    
    // Top Produk yang Sering Diproduksi
    public $topProducts = [];

    public function mount()
    {
        // Inisialisasi default values
        $this->topProducts = [];
        
        $this->loadData();
        $this->loadMonthlyOrderStats();
        $this->loadTopProducts();
        
        // Simpan ID aktivitas terbaru saat pertama load
        $latest = Aktivitas::latest()->first();
        $this->lastAktivitasId = $latest ? $latest->id : 0;
    }

    public function loadData()
    {
        // Load data order
        $this->totalOrder = Order::count();
        $this->orderPending = Order::where('status_order', 'pending')->count();
        $this->orderProses = Order::where('status_order', 'proses')->count();
        $this->orderSelesai = Order::where('status_order', 'selesai')->count();

        // Load aktivitas terbaru
        $this->aktivitasTerbaru = Aktivitas::with('user')
            ->latest()
            ->take(10)
            ->get();
    }

    public function loadMonthlyOrderStats()
    {
        // Ambil data 6 bulan terakhir
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months->push([
                'year' => $date->year,
                'month' => $date->month,
                'label' => $date->isoFormat('MMM Y')
            ]);
        }

        // Query TOTAL JUMLAH PRODUK per bulan
        $orders = Order::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(jumlah_order) as total_quantity')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('year', 'month')
            ->get()
            ->keyBy(function($item) {
                return $item->year . '-' . $item->month;
            });

        // Gabungkan dengan bulan yang tidak ada data
        $this->monthlyLabels = [];
        $this->monthlyOrderData = [];

        foreach ($months as $month) {
            $key = $month['year'] . '-' . $month['month'];
            $this->monthlyLabels[] = $month['label'];
            $this->monthlyOrderData[] = $orders->get($key)->total_quantity ?? 0;
        }

        // Dispatch event untuk update chart dengan data baru
        $this->dispatch('chart-updated', [
            'labels' => $this->monthlyLabels,
            'data' => $this->monthlyOrderData
        ]);
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

    public function checkNewActivity()
    {
        // Cek apakah ada aktivitas baru
        $latestActivity = Aktivitas::latest()->first();
        
        if ($latestActivity && $latestActivity->id > $this->lastAktivitasId) {
            // Ada aktivitas baru!
            $this->lastAktivitasId = $latestActivity->id;
            
            // Reload data
            $this->loadData();
            $this->loadTopProducts();
            
            // Kirim event ke frontend untuk tampilkan notifikasi
            $this->dispatch('new-activity', [
                'judul' => $latestActivity->judul,
                'deskripsi' => $latestActivity->deskripsi,
                'icon' => $latestActivity->icon,
                'warna' => $latestActivity->warna,
                'jenis' => $latestActivity->jenis
            ]);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.admin');
    }
}