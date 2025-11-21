@section('title')
Production List
@endsection
<div class="m-5">
    <h3>Daftar Order untuk Produksi</h3>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
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
                <td>{{ $order->id }}</td>
                <td>{{ $order->product->nama_produk ?? '-' }}</td>
                <td>{{ $order->nama_customer }}</td>
                <td>{{ $order->jumlah_order }}</td>
                <td>{{ strtoupper($order->status_order) }}</td>
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
</div>
