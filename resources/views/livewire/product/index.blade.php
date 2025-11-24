@section('title')
    Produk
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
            <a href="/product/create" wire:navigate class="btn btn-md btn-success rounded shadow-sm border-0 mb-3">ADD NEW
                PRODUCT</a>
            <div class="card-body">
                <table class="table table-striped table-hover table-bordered">
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
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->nama_produk }}</td>
                                <td>{{ $product->kategori_produk }}</td>
                                <td>{{ $product->deskripsi_produk}}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/').'/'. $product->gambar }}" class="rounded" style="width: 150px">
                                </td>
                                <td class="text-center">
                                    {{-- <a href="/order/edit/{{ $order->id }}" wire:navigate
                                        class="btn btn-sm btn-primary">EDIT</a> --}}
                                    <button wire:click="destroy({{ $product->id }})"
                                        class="btn btn-sm btn-danger">DELETE</button>
                                        <a href="{{route('product.edit', $product->id)}}" class="btn btn-sm btn-warning" wire:navigate>Edit</a>
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