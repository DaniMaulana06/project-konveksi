<?php

namespace App\Livewire\Owner\User;

use App\Models\User;
use Hash;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Create extends Component
{
    #[Rule('required', message: 'Nama tidak boleh kosong')]
    #[Rule('string', message: 'Nama harus berupa teks')]
    public $name;

    #[Rule('required', message: 'Email tidak boleh kosong')]
    #[Rule('email', message: 'Email tidak valid')]
    #[Rule('unique:users,email', message: 'Email sudah terdaftar')]
    public $email;

    #[Rule('required', message: 'Password tidak boleh kosong')]
    #[Rule('min:6', message: 'Password minimal 6 karakter')]
    public $password;

    #[Rule('required', message: 'Konfirmasi password wajib diisi')]
    public $password_confirmation;

    public $role;

    public function store(){
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            'email_verified_at' => now(),
        ]);

        session()->flash('message', 'User berhasil ditambahkan!');

        return redirect()->route('owner.user.index');
    }

    public function render()
    {
        return view('livewire.owner.user.create');
    }
}
