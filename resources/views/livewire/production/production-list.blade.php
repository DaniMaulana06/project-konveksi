@section('title', 'Production List')

<div class="container mt-5">

    {{-- CARD HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded-4 shadow-sm">
        <div class="card-body text-primary">
            <h4 class="mb-0 fw-bold">List Produksi</h4>
        </div>
    </div>

    {{-- SEARCH --}}
    <div class="card shadow-sm rounded-4 mb-4 border-0">
        <div class="card-body">
            <input type="text" 
                   class="form-control border-primary rounded-pill px-4" 
                   placeholder="Cari nama order, produk, atau customer..." 
                   wire:model.live.debounce.300ms="search">
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-lg rounded-4 border-0 overflow-hidden p-3">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="text-white" style="background: #0d6efd;">
                    <tr>
                        <th>No</th>
                        <th>Nama Order</th>
                        <th>Produk</th>
                        <th>Customer</th>
                        <th>Jumlah</th>
                        <th>Status Order</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($orders as $order)
                        <tr class="border-bottom">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->nama_order }}</td>
                            <td>{{ $order->product->nama_produk ?? '-' }}</td>
                            <td>{{ $order->nama_customer }}</td>
                            <td>{{ $order->jumlah_order }}</td>
                            <td>
                                @if ($order->status_order == 'pending')
                                    <span class="badge bg-secondary">Pending</span>
                                @elseif ($order->status_order == 'proses')
                                    <span class="badge bg-warning text-dark">Proses</span>
                                @elseif ($order->status_order == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif ($order->status_order == 'dikirim')
                                    <span class="badge bg-info text-dark">Dikirim</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('production.order.detail.list', $order->id) }}"
                                       class="btn btn-outline-primary btn-sm rounded-3 px-3" wire:navigate>
                                        Detail
                                    </a>
                                    <a href="{{ route('production.material.form', $order->id) }}"
                                       class="btn btn-outline-success btn-sm rounded-3 px-3"wire:navigate>
                                        Input Bahan
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                📭 Tidak ada data produksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Link ke List Bahan --}}
        <div class="card-footer bg-white border-0 mt-3">
            <a href="/produksi/material-list" wire:navigate 
               class="btn btn-primary btn-m rounded-pill" style="font-weight: bold">
               List Bahan Produksi
            </a>
        </div>
    </div>

</div>
