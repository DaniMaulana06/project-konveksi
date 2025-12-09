@section('title', 'Data Order')

<div class="container mt-2">

    {{-- ALERT --}}
    @if (session()->has('message'))
        <div class="alert alert-primary shadow-sm rounded-3 border-0">
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
            <h3 class="fw-bold text-primary mb-0">Data Order</h3>
            <small class="text-muted">Manajemen pesanan customer</small>
        </div>

    </div>

    {{-- SEARCH --}}
    <div class="card shadow-sm border-0 mb-4 rounded-4">
        <div class="card-body">
            <input type="text" class="form-control border-primary rounded-pill px-4"
                placeholder="Cari nama order atau customer..." wire:model.live.debounce="search">
        </div>
    </div>


    {{-- TABLE --}}
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden mb-3">
        <div class="table-responsive">
            <table class="table align-middle m-2">
                <thead style="background: #0d6efd;" class="text-white">
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>Nama Order</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @forelse ($orders as $order)
                        <tr class="border-bottom">
                            <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                            <td class="fw-semibold text-primary">{{ $order->id }}</td>
                            <td>{{ $order->nama_order }}</td>
                            <td>{{ $order->nama_customer }}</td>

                            <td>
                                {{ $order->created_at->format('d M Y') }} <br>
                                <small class="text-muted">{{ $order->created_at->format('H:i') }} WIB</small>
                            </td>

                            <td>
                                @if ($order->status_order == 'pending')
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">Pending</span>
                                @elseif ($order->status_order == 'proses')
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Proses</span>
                                @elseif ($order->status_order == 'selesai')
                                    <span class="badge bg-success px-3 py-2 rounded-pill">Selesai</span>
                                @elseif ($order->status_order == 'dikirim')
                                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill">Dikirim</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="/owner/order/{{ $order->id }}" wire:navigate
                                        class="btn btn-outline-primary btn-sm rounded-3 px-3">
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                Data order belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $orders->links('vendor.pagination.bootstrap-5') }}
</div>
