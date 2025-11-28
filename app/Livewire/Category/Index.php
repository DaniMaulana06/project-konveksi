<?php

namespace App\Livewire\Category;

use Livewire\Component;

class Index extends Component
{
    public function destroy($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $category->delete();

        session()->flash('message', 'Kategori berhasil dihapus: ' . $category->nama_kategori);
        redirect()->route('category.index');
    }

    public function render()
    {
        return view('livewire.category.index',[
            'categories' => \App\Models\Category::all()
        ]);
    }
}
