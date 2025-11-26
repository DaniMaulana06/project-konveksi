@section('title')
    List Order
@endsection

<div class="container md-5 mt-5">
    <div class="row">
        <div class="col-md-12">
            <!-- flash message -->
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <!-- end flash message -->
            <a href="/order/create" wire:navigate class="btn btn-md btn-success rounded shadow-sm border-0 mb-3">TAMBAH
                ORDER</a>
            <div class="card-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order ID</th>
                            <th>Nama Order</th>
                            <th>Nama Customer</th>
                            <th>Tanggal Order</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->nama_order }}</td>
                                <td>{{ $order->nama_customer }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}
                                    <br>
                                    <small class="text-muted">
                                        {{ $order->created_at->format('H:i') }} WIB
                                    </small>
                                </td>
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
                                <td class="text-center">
                                    {{-- <a href="/order/edit/{{ $order->id }}" wire:navigate
                                        class="btn btn-sm btn-primary">EDIT</a> --}}
                                    <a href="/order/detail/{{ $order->id }}" wire:navigate
                                        class="btn btn-sm btn-info text-white">DETAIL</a>

                                    <a href="{{ route('order.edit', $order->id) }}" wire:navigate
                                        class="btn btn-sm btn-warning text-white">Edit</a>

                                    <button wire:click="destroy({{ $order->id }})"
                                        class="btn btn-sm btn-danger">DELETE</button>
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