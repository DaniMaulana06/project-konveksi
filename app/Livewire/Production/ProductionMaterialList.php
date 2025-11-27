<?php

namespace App\Livewire\Production;

use App\Models\ProductionMaterial;
use Livewire\Component;
use Livewire\WithPagination;

class ProductionMaterialList extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'bootstrap';

    // Reset pagination saat search berubah
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Ambil semua ProductionMaterial dengan relasi
        $pm_list = ProductionMaterial::with(['material', 'productionList.order'])
            ->when($this->search, function ($query) {
                $query->whereHas('productionList.order', function ($q) {
                    $q->where('nama_order', 'like', '%' . $this->search . '%');
                })->orWhereHas('material', function ($q) {
                    $q->where('nama_bahan', 'like', '%' . $this->search . '%');
                });
            })
            ->get()
            ->groupBy('production_list_id');

        return view('livewire.production.production-material-list', compact('pm_list'));
    }
}
