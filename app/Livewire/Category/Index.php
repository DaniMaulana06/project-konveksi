<?php

namespace App\Livewire\Category;

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
        $category = \App\Models\Category::findOrFail($id);
        $category->delete();

        session()->flash('message', 'Kategori berhasil dihapus: ' . $category->nama_kategori);
        redirect()->route('category.index');
    }

    public function render()
    {
        $categories = \App\Models\Category::query()
        ->when($this->search, fn($query) =>
        $query->where('nama_kategori', 'like', '%' . $this->search . '%'))
        ->latest()->paginate(10);
        return view('livewire.category.index',[
            'categories' => $categories
        ]);
    }
}
