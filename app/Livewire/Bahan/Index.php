<?php

namespace App\Livewire\Bahan;

use App\Models\Bahan;
use Livewire\Component;

class Index extends Component
{
    public function destroy($id) {
        Bahan::destroy($id);
        session()->flash('message', 'Bahan deleted successfully.');
        return redirect()->route('bahan.index');
    }
    public function render()
    {
        $bahan = Bahan::all();
        return view('livewire.bahan.index', compact('bahan'));
    }
}
