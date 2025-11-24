@section('title')
    Order Detail List
@endsection

<div class="container my-4">
{{-- Detail Order --}}
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Order </h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Tanggal Order</th>
                        <td>{{ $order->created_at->format('d M Y') }}
                            <br>
                            <small class="text-muted">
                                {{ $order->created_at->format('H:i') }} WIB
                            </small>
                        </td>
                    </tr>
                    <tr>
                        <th>Terakhir Di Update</th>
                        <td>{{ $order->updated_at->format('d M Y') }}
                            <br>
                            <small class="text-muted">
                                {{ $order->updated_at->format('H:i') }}
                            </small>
                        </td>
                    </tr>
                    <tr>
                        <th width="30%">Nama Produk</th>
                        <td>{{ $order->product->nama_produk }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Order</th>
                        <td>{{ $order->jumlah_order }}</td>
                    </tr>
                    <tr>
                        <th>Total Harga</th>
                        <td><b>Rp {{ number_format($order->harga_total, 0, ',', '.') }}</b></td>
                    </tr>
                    <tr>
                        <th>File Panduan</th>
                        <td><a href="{{ asset('storage/') . '/' . $order->file_panduan }}" target="_blank"> File
                                Panduan</a></td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $order->keterangan }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge 
                                @if($order->status_order == 'pending') bg-secondary
                                @elseif($order->status_order == 'proses') bg-warning text-dark
                                @elseif($order->status_order == 'selesai') bg-success
                                @elseif($order->status_order == 'dikirim') bg-info text-dark
                                @endif">
                                {{ strtoupper($order->status_order) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-3">
                {{-- BUTTON AKSI --}}
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
                    <button wire:click="updateStatus('dikirim')" class="btn btn-primary">
                        Kirim Produk
                    </button>
                @endif
            </div>

            @if (session()->has('message'))
                <div class="alert alert-info mt-3">
                    {{ session('message') }}
                </div>
            @endif
        </div>

    </div>

    {{-- Input Bahan --}}
    <div class="card shadow-sm border-0 rounded-3 mt-3 mb-5">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Bahan Yang Digunakan </h4>
        </div>

        <div class="card-body">
    
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Dibuat Pada</th>
                        <th>Nama Bahan</th>
                        <th>Stok Awal</th>
                        <th>Jumlah Dipakai</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
    
                <tbody>
                    @if ($order->productionList)
                        @forelse($order->productionList->materials as $index => $pm)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pm->created_at->format('d M Y') }}
                                    <br>
                                    <small class="text-muted">
                                        {{ $pm->created_at->format('H:i') }} WIB
                                    </small>
                                </td>
                                <td>{{ $pm->material->nama_bahan ?? '-' }}</td>
                                <td>{{ $pm->material->stok + $pm->jumlah }}</td>
                                <td>{{ $pm->jumlah }}</td>
                                <td>{{ $pm->keterangan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada bahan yang diinput.</td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="5" class="text-center">Belum ada daftar produksi untuk order ini.</td>
                        </tr>
                    @endif
                </tbody>
    
            </table>
            <a href="{{ route('production.material.form', $order->id) }}" class="btn btn-success btn-sm">
                Input Bahan
            </a>
        </div>
    </div>

    
</div>