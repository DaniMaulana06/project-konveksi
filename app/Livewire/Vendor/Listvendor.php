<?php

namespace App\Livewire\Vendor;

use App\Models\Vendor;
use Livewire\Component;
use Livewire\WithPagination;

class Listvendor extends Component
{
    use WithPagination;
    
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $vendors = Vendor::query()
        ->when([
            $this->search,
            fn($query)=> 
            $query->where('nama_vendor','like','%'.$this->search.'%')
            ->orWhere('barang_vendor','like','%'.$this->search.'%')
            ->orWhere('no_vendor','like','%'.$this->search.'%')
        ])->latest()->paginate(10);
        return view('livewire.vendor.listvendor', compact('vendors'));
    }
}
