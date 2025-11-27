<?php

namespace App\Livewire\Bahan;

use App\Models\Bahan;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function destroy($id)
    {
        Bahan::destroy($id);
        session()->flash('message', 'Bahan deleted successfully.');
        return redirect()->route('bahan.index');
    }
    public function render()
    {
        $bahan = Bahan::query()
            ->when(
                $this->search,
                fn($query) => 
                $query->where('nama_bahan', 'like', '%' . $this->search . '%')
            )
            ->latest()
            ->paginate(10);

        $this->resetPage();
        return view('livewire.bahan.index', compact('bahan'));
    }
}
