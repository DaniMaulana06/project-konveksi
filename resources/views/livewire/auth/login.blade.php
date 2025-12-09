@section('title')
    Login
@endsection

<div class="vh-100 d-flex align-items-center justify-content-center overflow-hidden"
    style="background: linear-gradient(135deg, #1e3a8a, #2563eb); margin: 0; padding: 0; position: relative;">

    <div class="card border-0 shadow-lg rounded-4" style="width: 420px;">

        {{-- HEADER --}}
        <div class="text-center py-4 border-bottom">
            <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo" style="width:64px; height:64px;" class="mb-2">

            <h4 class="fw-bold mb-1">Selamat Datang</h4>
            <small class="text-muted">Silakan login untuk melanjutkan</small>
        </div>

        <div class="card-body px-4 py-4">

            {{-- ALERT --}}
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show small">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form wire:submit.prevent="login">

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label class="form-label small fw-semibold mb-1">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        wire:model.defer="email" placeholder="contoh@email.com">
                    @error('email')
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

                {{-- BUTTON --}}
                <div class="d-grid mt-4">
                    <button class="btn btn-primary rounded-3 py-2">
                        <span wire:loading.remove>Login</span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm"></span>
                            Memproses...
                        </span>
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
