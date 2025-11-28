<?php

namespace App\Livewire\Vendor;

use App\Models\Vendor;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $vendors = Vendor::all();
        return view('livewire.vendor.index', compact('vendors'));
    }
}
