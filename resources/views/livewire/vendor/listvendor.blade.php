@section('title', 'List Vendor')

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
                    <h3 class="fw-bold text-primary mb-0">List Vendor</h3>
                </div>
            </div>
            {{-- SEARCH --}}
            <div class="card shadow-sm border-0 mb-4 rounded-4">
                <div class="card-body">
                    <input type="text" class="form-control border-primary rounded-pill px-4"
                        placeholder="Cari nama vendor" wire:model.live="search">
                </div>
            </div>
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Vendor</th>
                                <th scope="col">Barang Vendor</th>
                                <th scope="col">Alamat Vendor</th>
                                <th scope="col">Telp Vendor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vendors as $index => $vendor)
                                <tr>
                                    <td>{{ ($vendors->currentPage() - 1) * $vendors->perPage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $vendor->nama_vendor }}</td>
                                    <td>{{ $vendor->barang_vendor }}</td>
                                    <td>{{ $vendor->alamat_vendor }}</td>
                                    <td>{{ $vendor->no_vendor }}</td>
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
