@section('title')
    Data Produk
@endsection

<div class="container md-5 mt-2">
    <div class="row mb-3">
        <div class="col md-12">
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
                    <h3 class="fw-bold text-primary mb-0">Data Produk</h3>
                    <small class="text-muted">Manajemen Produk</small>
                </div>
            </div>

            {{-- SEARCH --}}
            <div class="card shadow-sm border-0 mb-4 rounded-4">
                <div class="card-body">
                    <input type="text" class="form-control border-primary rounded-pill px-4"
                        placeholder="Cari nama produk" wire:model.live.debounce="search">
                </div>
            </div>

            {{-- body --}}
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Kategori Produk</th>
                                <th>Deskripsi Produk</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                                    <td>{{ $product->nama_produk }}</td>
                                    <td>{{ $product->category->nama_kategori }}</td>
                                    <td>{{ $product->deskripsi_produk}}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/') . '/' . $product->gambar }}" class="rounded"
                                            style="width: 150px">
                                    </td>
                                    <td class="text-center">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $products->links('vendor.pagination.bootstrap-5') }}
</div>