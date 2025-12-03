@section('title')
    Detail Order
@endsection

<div class="container-fluid mt-2">
    {{-- Header --}}
    <div class="card-header bg-white shadow-sm px-4 py-2 rounded-4 mb-4">
        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h3 class="fw-bold text-primary mb-1">
                    <i class="fas fa-file-invoice me-2"></i>Detail Order
                </h3>
                <p class="text-muted mb-0 small">Informasi lengkap pesanan</p>
            </div>
            <div>
                <a href="/order" wire:navigate class="btn btn-outline-primary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    @forelse($order_detail as $order)
        {{-- Main Card --}}
        <div class="row g-4">
            {{-- Left Column - Order Info --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary border-0 py-2">
                        <h5 class="fw-bold mb-0 text-white">
                            <i class="fas fa-info-circle me-2"></i> Informasi Order
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small mb-1">
                                        <i class="fas fa-hashtag me-1"></i>Order ID
                                    </label>
                                    <p class="fw-semibold mb-0">#{{ $order->id }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small mb-1">
                                        <i class="fas fa-calendar me-1"></i>Tanggal Order
                                    </label>
                                    <p class="fw-semibold mb-0">
                                        {{ $order->created_at->format('d M Y') }}
                                        <small class="text-muted ms-2">{{ $order->created_at->format('H:i') }} WIB</small>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small mb-1">
                                        <i class="fas fa-user me-1"></i>Nama Customer
                                    </label>
                                    <p class="fw-semibold mb-0">{{ $order->nama_customer }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small mb-1">
                                        <i class="fas fa-phone me-1"></i>Nomor Telepon
                                    </label>
                                    <p class="fw-semibold mb-0">{{ $order->no_telp }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small mb-1">
                                        <i class="fas fa-building me-1"></i>Asal Instansi
                                    </label>
                                    <p class="fw-semibold mb-0">{{ $order->asal_instansi }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small mb-1">
                                        <i class="fas fa-box me-1"></i>Nama Order
                                    </label>
                                    <p class="fw-semibold mb-0">{{ $order->nama_order }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small mb-1">
                                        <i class="fas fa-cubes me-1"></i>Jumlah Order
                                    </label>
                                    <p class="fw-semibold mb-0">{{ $order->jumlah_order }} Pcs</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small mb-1">
                                        <i class="fas fa-file-pdf me-1"></i>File Panduan
                                    </label>
                                    <p class="mb-0">
                                        <a href="{{ asset('storage/') . '/' . $order->file_panduan }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-download me-1"></i>Download
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('order.edit', $order->id) }}" wire:navigate
                            class="btn btn-warning btn-sm rounded-3 px-3 float-end">
                            Edit
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right Column - Summary --}}
            <div class="col-lg-4">
                {{-- Status Card --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-flag text-primary me-2"></i>Status Order
                        </h5>
                    </div>
                    <div class="card-body p-4 text-center">
                        @if ($order->status_order == 'pending')
                            <div class="status-badge bg-secondary bg-opacity-10 rounded-3 p-4">
                                <i class="fas fa-clock text-secondary fs-1 mb-3"></i>
                                <h5 class="fw-bold text-secondary mb-0">Pending</h5>
                                <small class="text-muted">Menunggu konfirmasi</small>
                            </div>
                        @elseif ($order->status_order == 'proses')
                            <div class="status-badge bg-warning bg-opacity-10 rounded-3 p-4">
                                <i class="fas fa-cog fa-spin text-warning fs-1 mb-3"></i>
                                <h5 class="fw-bold text-warning mb-0">Proses</h5>
                                <small class="text-muted">Sedang dikerjakan</small>
                            </div>
                        @elseif ($order->status_order == 'selesai')
                            <div class="status-badge bg-success bg-opacity-10 rounded-3 p-4">
                                <i class="fas fa-check-circle text-success fs-1 mb-3"></i>
                                <h5 class="fw-bold text-success mb-0">Selesai</h5>
                                <small class="text-muted">Order telah selesai</small>
                            </div>
                        @elseif ($order->status_order == 'dikirim')
                            <div class="status-badge bg-info bg-opacity-10 rounded-3 p-4">
                                <i class="fas fa-truck text-info fs-1 mb-3"></i>
                                <h5 class="fw-bold text-info mb-0">Dikirim</h5>
                                <small class="text-muted">Dalam pengiriman</small>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Price Card --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-money-bill-wave text-primary me-2"></i>Total Harga
                        </h5>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h2 class="fw-bold text-success mb-0">
                            Rp{{ number_format($order->harga_total, 0, ',', '.') }}
                        </h2>
                        <small class="text-muted">Total pembayaran</small>
                    </div>
                </div>

                {{-- Action Button --}}
                @if ($order->status_order == 'dikirim')
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 text-center">
                            <button wire:click="terimaOrder({{ $order->id }})" class="btn btn-success w-100 py-3">
                                <i class="fas fa-check-circle me-2"></i>Terima Order
                            </button>
                            <small class="text-muted d-block mt-2">
                                Klik untuk konfirmasi penerimaan
                            </small>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-inbox text-muted fs-1 mb-3 d-block"></i>
                <h5 class="text-muted">Data order tidak ditemukan</h5>
            </div>
        </div>
    @endforelse
</div>

@push('styles')
    <style>
        .info-item {
            padding: 12px;
            background-color: #f8f9fa;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background-color: #e9ecef;
            transform: translateY(-2px);
        }

        .status-badge {
            transition: all 0.3s ease;
        }

        .status-badge:hover {
            transform: scale(1.05);
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }
    </style>
@endpush
