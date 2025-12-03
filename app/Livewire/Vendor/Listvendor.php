<?php

namespace App\Livewire\Vendor;

use App\Models\Vendor;
use Livewire\Component;
use Livewire\WithPagination;

class Listvendor extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $vendors = Vendor::query()
            ->when($this->search, function ($query) {
                $query->where('nama_vendor', 'like', '%' . $this->search . '%')
                    ->orWhere('barang_vendor', 'like', '%' . $this->search . '%')
                    ->orWhere('no_vendor', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.vendor.listvendor', compact('vendors'));
    }
}
