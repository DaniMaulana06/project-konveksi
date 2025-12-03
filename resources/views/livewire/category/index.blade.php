@section('title', 'Kategori')

<div class="container mt-2">

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
            <h3 class="fw-bold text-primary mb-0">Daftar Kategori Produk</h3>
        </div>

        <a href="/kategori/create" wire:navigate class="btn btn-primary shadow-sm rounded-3 px-4 fw-semibold">
            + Tambah Kategori
        </a>
    </div>

    {{-- SEARCH (optional, bisa ditambahkan nanti) --}}

    <div class="card shadow-sm border-0 mb-4 rounded-4">
        <div class="card-body">
            <input type="text" class="form-control border-primary rounded-pill px-4" placeholder="Cari kategori..."
                wire:model.live.debounce.300ms="search">
        </div>
    </div>


    {{-- TABLE --}}
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden p-3 mb-3">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="text-white" style="background: #0d6efd;">
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($categories as $category)
                        <tr class="border-bottom">
                            <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                            <td class="fw-semibold text-primary">{{ $category->nama_kategori }}</td>
                            <td>{{ $category->deskripsi }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('category.edit', $category->id) }}"
                                        class="btn btn-outline-warning btn-sm rounded-3 px-3 text-yellow">
                                        Edit
                                    </a>
                                    <button class="btn btn-outline-danger btn-sm rounded-3 px-3"
                                        wire:click="destroy({{ $category->id }})">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                📭 Tidak ada data kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $categories->links('vendor.pagination.bootstrap-5') }}
</div>
