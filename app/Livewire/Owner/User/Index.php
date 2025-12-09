<?php

namespace App\Livewire\Owner\User;

use App\Models\User;
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
        $user = User::findOrFail($id);

        // Prevent deleting own account
        if ($user->id === auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
            return;
        }

        $user->delete();
        session()->flash('message', 'User berhasil dihapus!');
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('role', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.owner.user.index', compact('users'));
    }
}
