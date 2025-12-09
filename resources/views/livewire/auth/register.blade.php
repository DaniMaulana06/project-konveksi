@section('title')
    Register
@endsection

<div class="vh-100 d-flex align-items-center justify-content-center overflow-hidden"
    style="background: linear-gradient(135deg, #1e3a8a, #2563eb); margin: 0; padding: 0; position: relative;">

    <div class="card border-0 shadow-lg rounded-4" style="width: 480px; max-height: 95vh; overflow-y: auto;">

        {{-- HEADER --}}
        <div class="text-center py-4 border-bottom">
            <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo" style="width:64px; height:64px;" class="mb-2">

            <h4 class="fw-bold mb-1">Buat Akun Baru</h4>
            <small class="text-muted">Lengkapi data untuk mendaftar</small>
        </div>

        <div class="card-body px-4 py-4">

            <form wire:submit.prevent="register">

                {{-- NAMA --}}
                <div class="mb-3">
                    <label class="form-label small fw-semibold mb-1">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        wire:model.defer="name" placeholder="Nama lengkap">
                    @error('name')
                        <div class="invalid-feedback small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label class="form-label small fw-semibold mb-1">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        wire:model.defer="email" placeholder="contoh@email.com">
                    @error('email')
                        <div class="invalid-feedback small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ROLE --}}
                <div class="mb-3">
                    <label class="form-label small fw-semibold mb-1">Role</label>
                    <select class="form-select @error('role') is-invalid @enderror" wire:model.defer="role">
                        <option value="">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="produksi">Produksi</option>
                        <option value="owner">Owner</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="mb-3">
                    <label class="form-label small fw-semibold mb-1">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        wire:model.defer="password" placeholder="********">
                    @error('password')
                        <div class="invalid-feedback small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div class="mb-3">
                    <label class="form-label small fw-semibold mb-1">Konfirmasi Password</label>
                    <input type="password" class="form-control" wire:model.defer="password_confirmation"
                        placeholder="Ulangi password">
                </div>

                {{-- BUTTON --}}
                <div class="d-grid mt-4">
                    <button class="btn btn-primary rounded-3 py-2">
                        <span wire:loading.remove>Daftar</span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm"></span>
                            Memproses...
                        </span>
                    </button>
                </div>

            </form>

            {{-- LOGIN LINK --}}
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
