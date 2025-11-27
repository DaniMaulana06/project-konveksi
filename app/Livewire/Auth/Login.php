<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    protected $messages = [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 6 karakter.',
    ];

    public function mount() {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
    }
    public function login() {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            
            session()->regenerate();
            session()->flash('message', 'Login berhasil! Selamat datang '.Auth::user()->name.'.');
            
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif (Auth::user()->role === 'produksi') {
                return redirect()->intended('/produksi/dashboard');
            }
        }

        $this->addError('email', 'Email atau password salah.');
        $this->password = null;
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
