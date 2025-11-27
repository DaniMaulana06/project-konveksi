@section('title')
Register
@endsection

<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h4 class="mb-0 fw-bold">Buat Akun Baru</h4>
                        <small class="opacity-75">Lengkapi data untuk mendaftar</small>
                    </div>

                    <div class="card-body p-4">

                        <form wire:submit.prevent="register">

                            {{-- Nama --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama</label>
                                <input type="text"
                                    class="form-control rounded-3 @error('name') is-invalid @enderror"
                                    wire:model.defer="name"
                                    placeholder="Nama lengkap">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email"
                                    class="form-control rounded-3 @error('email') is-invalid @enderror"
                                    wire:model.defer="email"
                                    placeholder="contoh@email.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Role --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Role</label>
                                <select
                                    class="form-select rounded-3 @error('role') is-invalid @enderror"
                                    wire:model.defer="role">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin">Admin</option>
                                    <option value="produksi">Produksi</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password"
                                    class="form-control rounded-3 @error('password') is-invalid @enderror"
                                    wire:model.defer="password"
                                    placeholder="••••••••">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Konfirmasi Password</label>
                                <input type="password"
                                    class="form-control rounded-3"
                                    wire:model.defer="password_confirmation"
                                    placeholder="Ulangi password">
                            </div>

                            {{-- Button --}}
                            <div class="d-grid mt-4">
                                <button class="btn btn-primary btn-lg rounded-3">
                                    <span wire:loading.remove>Daftar</span>
                                    <span wire:loading>
                                        <span class="spinner-border spinner-border-sm"></span>
                                        Memproses...
                                    </span>
                                </button>
                            </div>

                        </form>

                        <div class="text-center mt-4">
                            <small class="text-muted">
                                Sudah punya akun?
                                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold" wire:navigate>
                                    Login
                                </a>
                            </small>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
