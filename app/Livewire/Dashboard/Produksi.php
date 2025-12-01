<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Order;
use App\Models\Bahan;
use App\Models\Aktivitas;
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
    
    // Notifikasi Aktivitas Terbaru
    public $recentActivities;
    
    public function mount()
    {
        // Inisialisasi default values
        $this->recentActivities = [];
        
        // Data Order
        $this->totalOrder   = Order::count();
        $this->orderPending = Order::where('status_order', 'pending')->count();
        $this->orderProses  = Order::where('status_order', 'proses')->count();
        $this->orderDikirim = Order::where('status_order', 'dikirim')->count();
        $this->orderSelesai = Order::where('status_order', 'selesai')->count();
        
        // Data Bahan
        $this->totalMaterials = Bahan::count();
        $this->lowStock = Bahan::where('stok', '<', 20)->count();
        
        // Load Recent Activities
        $this->loadRecentActivities();
    }
    
    public function loadRecentActivities()
    {
        try {
            // Ambil 10 aktivitas terbaru dengan relasi user
            $this->recentActivities = Aktivitas::with('user')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get()
                ->map(function($activity) {
                    return [
                        'id' => $activity->id,
                        'jenis' => $activity->jenis,
                        'judul' => $activity->judul,
                        'deskripsi' => $activity->deskripsi,
                        'icon' => $activity->icon,
                        'warna' => $activity->warna,
                        'time' => $activity->created_at,
                        'user' => $activity->user ? $activity->user->name : 'System',
                        'time_diff' => $activity->created_at->diffForHumans()
                    ];
                })
                ->toArray();

        } catch (\Exception $e) {
            $this->recentActivities = [];
            Log::error('Error loading recent activities: ' . $e->getMessage());
        }
    }
    
    public function refreshActivities()
    {
        $this->loadRecentActivities();
        $this->dispatch('activities-refreshed');
    }
    
    public function markAsRead($activityId)
    {
        // Opsional: jika ingin menambah fitur mark as read
        // bisa tambahkan kolom 'is_read' di tabel aktivitas
        $this->dispatch('activity-marked', ['id' => $activityId]);
    }

    public function render()
    {
        return view('livewire.dashboard.produksi');
    }
}