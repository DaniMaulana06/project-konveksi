@section('title', 'Manajemen User')

<div class="container mt-2">

    {{-- ALERT --}}
    @if (session()->has('message'))
        <div class="alert alert-success shadow-sm rounded-3 border-0">
            {{ session('message') }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger shadow-sm rounded-3 border-0">
            {{ session('error') }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded-4 shadow-sm">
        <div>
            <h3 class="fw-bold text-primary mb-0">Manajemen User</h3>
            <small class="text-muted">Kelola pengguna sistem</small>
        </div>
        <a href="{{ route('owner.user.create') }}" wire:navigate class="btn btn-primary rounded-3 px-4">
            <i class="fas fa-plus me-2"></i>Tambah User
        </a>
    </div>

    {{-- SEARCH --}}
    <div class="card shadow-sm border-0 mb-4 rounded-4">
        <div class="card-body">
            <input type="text" class="form-control border-primary rounded-pill px-4"
                placeholder="Cari nama, email, atau role..." wire:model.live.debounce="search">
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden mb-3">
        <div class="table-responsive">
            <table class="table align-middle m-2">
                <thead style="background: #0d6efd;" class="text-white">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Terdaftar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @forelse ($users as $user)
                        <tr class="border-bottom">
                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->role == 'admin')
                                    <span class="badge bg-primary px-3 py-2 rounded-pill">Admin</span>
                                @elseif ($user->role == 'produksi')
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Produksi</span>
                                @elseif ($user->role == 'owner')
                                    <span class="badge bg-success px-3 py-2 rounded-pill">Owner</span>
                                @endif
                            </td>
                            <td>
                                {{ $user->created_at->format('d M Y') }} <br>
                                <small class="text-muted">{{ $user->created_at->format('H:i') }} WIB</small>
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @if ($user->id !== auth()->id())
                                        <a href="{{ route('owner.user.edit', $user->id) }}"
                                            class="btn btn-outline-primary btn-sm rounded-3 px-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button wire:click="destroy({{ $user->id }})"
                                            wire:confirm="Apakah Anda yakin ingin menghapus user {{ $user->name }}?"
                                            class="btn btn-outline-danger btn-sm rounded-3 px-3">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @else
                                        <span class="badge bg-secondary px-3 py-2">Akun Anda</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                📭 Data user belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $users->links('vendor.pagination.bootstrap-5') }}

</div>
