@section('title')
    Detail Order
@endsection
<div class="m-5">
    <h1 class="text-2xl font-bold mb-4">Detail Order</h1>
    <div class="card-body">
        <table class="table table-striped-columns table-bordered table-hover">
            <tbody>
                @forelse($order_detail as $order)
                    <tr>
                        <td><strong>Order ID</strong></td>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Customer</strong></td>
                        <td>{{ $order->nama_customer }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Order</strong>
                        <td>{{ $order->nama_order }}</td></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Order</strong></td>
                        <td>{{ $order->created_at->format('d M Y') }}
                            <br>
                            <small class="text-muted">
                                {{$order->created_at->format('H:i')}}
                            </small>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Nomor Telepon</strong></td>
                        <td>{{ $order->no_telp }}</td>
                    </tr>
                    <tr>
                        <td><strong>Asal Instansi</strong></td>
                        <td>{{ $order->asal_instansi }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jumlah Order</strong></td>
                        <td>{{ $order->jumlah_order }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Harga</strong></td>
                        <td>Rp{{ number_format($order->harga_total, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td><strong>File Panduan</strong></td>
                        <td>
                            <a href="{{ asset('storage/') . '/' . $order->file_panduan }}" target="_blank"> File Panduan</a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="/order" wire:navigate class="btn btn-sm btn-primary">Kembali</a>
        <a href="/order/edit/{{ $order->id }}" class="btn btn-sm btn-warning">Edit</a>
    </div>
</div>