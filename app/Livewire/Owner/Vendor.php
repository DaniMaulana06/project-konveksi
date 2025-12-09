<?php

namespace App\Livewire\Owner;

use Livewire\Component;
use Livewire\WithPagination;

class Vendor extends Component
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
        $vendors = \App\Models\Vendor::query()
            ->when($this->search, function ($query) {
                $query->where('nama_vendor', 'like', '%' . $this->search . '%')
                    ->orWhere('barang_vendor', 'like', '%' . $this->search . '%')
                    ->orWhere('no_vendor', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.owner.vendor', compact('vendors'));
    }
}
