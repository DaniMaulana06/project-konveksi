<?php

namespace App\Livewire\Vendor;

use App\Models\Vendor;
use Livewire\Component;

class Index extends Component
{
    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        if ($vendor) {
            $vendor->delete();
            session()->flash('message', 'Vendor berhasil dihapus.');
        } else {
            session()->flash('error', 'Vendor tidak ditemukan.');
        }
    }
    public function render()
    {
        $vendors = Vendor::all();
        return view('livewire.vendor.index', compact('vendors'));
    }
}
