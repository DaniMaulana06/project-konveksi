@section('title', 'Tambah User')

<div class="container mt-2">

    {{-- ALERT --}}
    @if (session()->has('message'))
        <div class="alert alert-success shadow-sm rounded-3 border-0">
            {{ session('message') }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded-4 shadow-sm">
        <div>
            <h3 class="fw-bold text-primary mb-0">Tambah User Baru</h3>
            <small class="text-muted">Buat akun pengguna baru</small>
        </div>
        <a href="{{ route('owner.user.index') }}" wire:navigate class="btn btn-outline-secondary rounded-3 px-4">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- FORM --}}
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden mb-3">
        <div class="card-body p-4">
            <form wire:submit.prevent="store">

                {{-- NAMA --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        wire:model.defer="name" placeholder="Nama lengkap">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        wire:model.defer="email" placeholder="contoh@email.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ROLE --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Role</label>
                    <select class="form-select @error('role') is-invalid @enderror" wire:model.defer="role">
                        <option value="">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="produksi">Produksi</option>
                        <option value="owner">Owner</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        wire:model.defer="password" placeholder="Minimal 6 karakter">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Konfirmasi Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        wire:model.defer="password_confirmation" placeholder="Ulangi password">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTONS --}}
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary rounded-3 px-4">
                        <span wire:loading.remove>
                            <i class="fas fa-save me-2"></i>Simpan
                        </span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm me-2"></span>
                            Memproses...
                        </span>
                    </button>
                    <a href="{{ route('owner.user.index') }}" wire:navigate
                        class="btn btn-outline-secondary rounded-3 px-4">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
