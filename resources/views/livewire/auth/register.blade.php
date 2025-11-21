@section('title')
Register
@endsection

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header text-white text-center">
                    <h4>Register</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="register">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" wire:model="email">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Role</label>
                            <select class="form-control" wire:model="role">
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="produksi">Produksi</option>
                            </select>
                            @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control" wire:model="password">
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Konfirmasi Password</label>
                            <input type="password" class="form-control" wire:model="password_confirmation">
                        </div>

                        <button class="btn btn-primary w-100">Daftar</button>
                    </form>

                    <div class="mt-3 text-center">
                        <small>Sudah punya akun? <a href="{{ route('login') }}" wire:navigate>Login</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
