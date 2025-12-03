@section('title', 'Vendor')

<div class="container mb-5 md-5 mt-2">
    <div class="row">
        <div class="col md-12 mb-3">
            <!-- flash message -->
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- end flash message -->
            {{-- header --}}
            <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded-4 shadow-sm">
                <div>
                    <h3 class="fw-bold text-primary mb-0">Data Vendor</h3>
                </div>

                <a href="{{ route('vendor.create') }}" wire:navigate
                    class="btn btn-primary shadow-sm rounded-3 px-4 fw-semibold">
                    + Tambah Vendor
                </a>
            </div>

            {{-- SEARCH --}}
            <div class="card shadow-sm border-0 mb-4 rounded-4">
                <div class="card-body">
                    <input type="text" class="form-control border-primary rounded-pill px-4"
                        placeholder="Cari nama Vendor" wire:model.live="search">
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Vendor</th>
                                <th scope="col">Barang Vendor</th>
                                <th scope="col">Alamat Vendor</th>
                                <th scope="col">Telp Vendor</th>
                                <th scope="col" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vendors as $index => $vendor)
                                <tr>
                                    <td>{{ ($vendors->currentPage() - 1) * $vendors->perPage() + $loop->iteration }}</td>
                                    <td>{{ $vendor->nama_vendor }}</td>
                                    <td>{{ $vendor->barang_vendor }}</td>
                                    <td>{{ $vendor->alamat_vendor }}</td>
                                    <td>{{ $vendor->no_vendor }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-sm btn-primary me-2">Edit</a>
                                        <button wire:click="destroy({{ $vendor->id }})" class="btn btn-sm btn-danger">Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data Vendor Belum Tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $vendors->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>