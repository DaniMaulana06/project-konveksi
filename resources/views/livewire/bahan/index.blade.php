@section('title')
    Bahan
@endsection

<div class="container mt-5">
    {{-- ALERT --}}
    @if (session()->has('message'))
        <div class="alert alert-primary shadow-sm rounded-3 border-0">
            {{ session('message') }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded-4 shadow-sm">
        <div>
            <h3 class="fw-bold text-primary mb-0">Data Bahan</h3>
            <small class="text-muted">Manajemen Bahan Produksi</small>
        </div>

        <a href="/bahan/create" wire:navigate class="btn btn-primary shadow-sm rounded-3 px-4 fw-semibold">
            + Tambah Bahan
        </a>
    </div>

    {{-- SEARCH (optional, bisa ditambahkan nanti) --}}

    <div class="card shadow-sm border-0 mb-4 rounded-4">
        <div class="card-body">
            <input type="text" class="form-control border-primary rounded-pill px-4"
                placeholder="Cari nama bahan..." wire:model.live="search">
        </div>
    </div>


    {{-- TABLE --}}
    <div class="card shadow-lg rounded-4 border-0 overflow-hidden p-3">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="text-white" style="background: #0d6efd;">
                    <tr>
                        <th>No</th>
                        <th>Nama Bahan</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bahan as $b)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $b->nama_bahan }}</td>
                            <td>{{ $b->satuan }}</td>
                            <td>{{ $b->stok }}</td>
                            <td class="text-center">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('bahan.edit', $b->id) }}"
                                        class="btn btn-sm btn-outline-warning text-center text-yellow">Edit</a>
                                    <button class="btn btn-outline-danger btn-sm rounded-3"
                                        wire:click="destroy({{ $b->id }})">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                    @endforeach
                        @if($bahan->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">Data bahan kosong</td>
                            </tr>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>