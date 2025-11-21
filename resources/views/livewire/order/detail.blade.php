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
                        <td><strong>Tanggal Order</strong></td>
                        <td>{{ $order->tgl_order }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Customer</strong></td>
                        <td>{{ $order->nama_customer }}</td>
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
                        <td>Rp{{ $order->harga_total }}</td>
                    </tr>
                    <tr>
                        <td><strong>File Panduan</strong></td>
                        <td>{{ $order->file_panduan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>{{ $order->status_order }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="/order" wire:navigate class="btn btn-sm btn-primary">Kembali</a>
    </div>
</div>
