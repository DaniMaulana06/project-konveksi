@section('title')
    Order Detail List
@endsection
<div class="m-5">
    <h3>Order ID {{ $order->id }}</h3>
    <h3>Product Name: {{ $order->product->nama_produk }}</h3>
    <p><b>Jumlah Order:</b> {{ $order->jumlah_order }}</p>
    <p><b>Harga Satuan:</b> {{ $order->harga_satuan }}</p>
    <p><b>Total Harga:</b> {{ $order->total_harga }}</p>
    <p><b>Status:</b> {{ strtoupper($order->status_order) }}</p>

    {{-- TOMBOL UNTUK PRODUKSI --}}
    @if($order->status_order === 'pending')
        <button wire:click="updateStatus('proses')" class="btn btn-warning">
            Mulai Produksi
        </button>
    @endif

    @if($order->status_order === 'proses')
        <button wire:click="updateStatus('selesai')" class="btn btn-success">
            Tandai Produksi Selesai
        </button>
    @endif

    @if ($order->status_order === 'selesai')
    <button wire:click="updateStatus('dikirim')" class="btn btn-warning">
        Kirim Produk
    </button>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-info mt-3">
            {{ session('message') }}
        </div>
    @endif
</div>
