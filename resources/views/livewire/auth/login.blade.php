@section('title')
Login
@endsection

<div class="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                {{-- Alert --}}
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h4 class="mb-0 fw-bold">Selamat Datang</h4>
                        <small class="opacity-75">Silakan login untuk melanjutkan</small>
                    </div>

                    <div class="card-body p-4">

                        <form wire:submit.prevent="login">
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

                            {{-- Button --}}
                            <div class="d-grid mt-4">
                                <button class="btn btn-primary btn-lg rounded-3">
                                    <span wire:loading.remove>Login</span>
                                    <span wire:loading>
                                        <span class="spinner-border spinner-border-sm"></span>
                                        Memproses...
                                    </span>
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <small class="text-muted">
                                Belum punya akun?
                                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold" wire:navigate>
                                    Daftar
                                </a>
                            </small>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
