@section('title')
    Production List
@endsection
<div class="m-5">
    <div class="row">
        <div class="col md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">List Produksi</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
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

                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->nama_order }}</td>
                                    <td>{{ $order->product->nama_produk ?? '-' }}</td>
                                    <td>{{ $order->nama_customer }}</td>
                                    <td>{{ $order->jumlah_order }}</td>
                                    <td>
                                        @if ($order->status_order == 'pending')
                                            <span class="badge text-bg-secondary">Pending</span>
                                        @elseif ($order->status_order == 'proses')
                                            <span class="badge text-bg-warning">Proses</span>
                                        @elseif ($order->status_order == 'selesai')
                                            <span class="badge text-bg-success">Selesai</span>
                                        @elseif ($order->status_order == 'dikirim')
                                            <span class="badge text-bg-info">Dikirim</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('production.order.detail.list', $order->id) }}"
                                            class="btn btn-primary btn-sm">
                                            Detail
                                        </a>
                                        <a href="{{ route('production.material.form', $order->id) }}"
                                            class="btn btn-success btn-sm">
                                            Input Bahan
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="/produksi/material-list" wire:navigate class="btn btn-sm btn-primary">List Bahan
                        Produksi</a>
                </div>
            </div>
        </div>
    </div>


</div>