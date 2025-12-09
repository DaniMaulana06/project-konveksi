<?php

namespace App\Livewire\Owner\User;

use App\Models\User;
use Hash;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Edit extends Component
{
    public $userId;
    public $user;

    #[Rule('required', message: 'Nama tidak boleh kosong')]
    #[Rule('string', message: 'Nama harus berupa teks')]
    public $name;

    #[Rule('required', message: 'Email tidak boleh kosong')]
    #[Rule('email', message: 'Email tidak valid')]
    public $email;

    #[Rule('nullable')]
    #[Rule('min:6', message: 'Password minimal 6 karakter')]
    public $password;

    #[Rule('nullable')]
    public $password_confirmation;

    #[Rule('required', message: 'Role tidak boleh kosong')]
    public $role;

    public function mount($id)
    {
        $this->userId = $id;
        $this->user = User::findOrFail($id);

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->role = $this->user->role;
    }

    public function update()
    {
        // Validate email uniqueness except for current user
        $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->userId,
        ]);

        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        // Only update password if provided
        if (!empty($this->password)) {
            if ($this->password !== $this->password_confirmation) {
                $this->addError('password_confirmation', 'Konfirmasi password tidak cocok');
                return;
            }
            $data['password'] = Hash::make($this->password);
        }

        $this->user->update($data);

        session()->flash('message', 'User berhasil diperbarui!');

        return redirect()->route('owner.user.index');
    }

    public function render()
    {
        return view('livewire.owner.user.edit');
    }
}
