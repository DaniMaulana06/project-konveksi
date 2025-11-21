@section('title')
Login
@endsection

<div class="container mt-5">
    <div class="row justify-content-center">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header text-white text-center">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="login">
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" wire:model="email">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control" wire:model="password">
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <button class="btn btn-primary w-100">Login</button>
                    </form>

                    <div class="mt-3 text-center">
                        <small>Belum punya akun? <a href="{{ route('register') }}" wire:navigate>Daftar</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>