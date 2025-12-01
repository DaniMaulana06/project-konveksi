{{-- Dashboard Konveksi dengan Statistik Lengkap --}}
<div>
    <div class="container-fluid p-4">
        {{-- Header Card --}}
        <div class="card border-0 shadow-sm mb-4 header-card">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="header-icon-box rounded-3 p-3 me-3">
                                <i class="fas fa-chart-line text-white fs-2"></i>
                            </div>
                            <div>
                                <h2 class="fw-bold mb-1 text-primary">Dashboard Produksi</h2>
                                <p class="text-muted mb-0 small">Monitoring & Analisis Produksi Real-time</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <div class="d-flex align-items-center justify-content-md-end">
                            <div class="date-box bg-light rounded-3 p-3">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                <span class="fw-semibold">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Order Cards --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-4 col-lg">
                <div class="card border-0 shadow-sm h-100 card-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="icon-box bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-shopping-cart text-primary fs-4"></i>
                            </div>
                            <span class="badge bg-primary-subtle text-primary">Total</span>
                        </div>
                        <h3 class="fw-bold text-dark mb-1">{{ $totalOrder ?? 0 }}</h3>
                        <p class="text-muted small mb-0">Total Order</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg">
                <div class="card border-0 shadow-sm h-100 card-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="icon-box bg-warning bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-clock text-warning fs-4"></i>
                            </div>
                            <span class="badge bg-warning-subtle text-warning">Menunggu</span>
                        </div>
                        <h3 class="fw-bold text-dark mb-1">{{ $orderPending ?? 0 }}</h3>
                        <p class="text-muted small mb-0">Pending</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg">
                <div class="card border-0 shadow-sm h-100 card-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="icon-box bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-cog fa-spin text-info fs-4"></i>
                            </div>
                            <span class="badge bg-info-subtle text-info">Produksi</span>
                        </div>
                        <h3 class="fw-bold text-dark mb-1">{{ $orderProses ?? 0 }}</h3>
                        <p class="text-muted small mb-0">Sedang Diproses</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg">
                <div class="card border-0 shadow-sm h-100 card-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="icon-box bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-check-circle text-success fs-4"></i>
                            </div>
                            <span class="badge bg-success-subtle text-success">Selesai</span>
                        </div>
                        <h3 class="fw-bold text-dark mb-1">{{ $orderSelesai ?? 0 }}</h3>
                        <p class="text-muted small mb-0">Selesai</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg">
                <div class="card border-0 shadow-sm h-100 card-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="icon-box bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-truck text-info fs-4"></i>
                            </div>
                            <span class="badge bg-info-subtle text-info">Dikirim</span>
                        </div>
                        <h3 class="fw-bold text-dark mb-1">{{ $orderDikirim ?? 0 }}</h3>
                        <p class="text-muted small mb-0">Dikirim</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistik Bahan --}}
        <div class="row g-3 mb-4">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold mb-0">
                                <i class="fas fa-boxes text-primary me-2"></i>Status Bahan
                            </h5>
                            <a href="/bahan/create" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-plus me-1"></i>Tambah Bahan
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 bg-light border-start border-4 border-primary">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-muted small mb-1">Total Bahan</p>
                                            <h4 class="fw-bold mb-0">{{ $totalMaterials ?? 0 }}</h4>
                                        </div>
                                        <i class="fas fa-warehouse text-primary fs-2"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 bg-light border-start border-4 border-danger">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="text-muted small mb-1">Stok Menipis</p>
                                            <h4 class="fw-bold mb-0 text-danger">{{ $lowStock ?? 0 }}</h4>
                                        </div>
                                        <i class="fas fa-exclamation-triangle text-danger fs-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(($lowStock ?? 0) > 0)
                        <div class="alert alert-warning border-0 mt-4 mb-0" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-bell me-3 fs-5"></i>
                                <div>
                                    <strong>Perhatian!</strong>
                                    <p class="mb-0 small">Ada {{ $lowStock }} bahan dengan stok menipis</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Top Produk --}}
        <div class="row g-3">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-fire text-danger me-2"></i>Top Barang Paling Sering Diproduksi
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 ps-4">Rank</th>
                                        <th class="border-0">Nama Produk</th>
                                        <th class="border-0">Kategori</th>
                                        <th class="border-0 text-center">Jumlah Order</th>
                                        <th class="border-0 text-center">Total Produksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(($topProducts ?? []) as $index => $product)
                                    <tr>
                                        <td class="ps-4">
                                            @if($index == 0)
                                                <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                                                    <i class="fas fa-crown me-1"></i>#{{ $index + 1 }}
                                                </span>
                                            @elseif($index == 1)
                                                <span class="badge bg-secondary fs-6 px-3 py-2">
                                                    <i class="fas fa-medal me-1"></i>#{{ $index + 1 }}
                                                </span>
                                            @elseif($index == 2)
                                                <span class="badge bg-danger fs-6 px-3 py-2">
                                                    <i class="fas fa-award me-1"></i>#{{ $index + 1 }}
                                                </span>
                                            @else
                                                <span class="badge bg-light text-dark fs-6 px-3 py-2">#{{ $index + 1 }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                                                    <i class="fas fa-box text-primary"></i>
                                                </div>
                                                <h6 class="mb-0">{{ $product['nama_produk'] }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info-subtle text-info">
                                                {{ $product['kategori'] ?? 'Uncategorized' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary-subtle text-primary fs-6 px-3 py-2">
                                                {{ $product['total_orders'] }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <strong class="text-success">{{ $product['total_quantity'] }} pcs</strong>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <i class="fas fa-inbox text-muted fs-1 mb-3 d-block"></i>
                                            <p class="text-muted mb-0">Belum ada data produksi</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .header-card {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }
        
        .header-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
        }

        .header-icon-box {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%) !important;
        }

        .date-box {
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .date-box:hover {
            background-color: #e9ecef !important;
            transform: scale(1.05);
        }

        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12) !important;
        }

        .icon-box {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
        }

        .bg-primary-subtle { background-color: rgba(13, 110, 253, 0.1) !important; }
        .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
        .bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1) !important; }
        .bg-info-subtle { background-color: rgba(13, 202, 240, 0.1) !important; }

        .table thead th {
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: background-color 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        @media (max-width: 768px) {
            h1 { font-size: 1.5rem; }
            h3 { font-size: 1.75rem; }
            .icon-box { width: 50px; height: 50px; }
            .header-icon-box { width: 50px; height: 50px; }
            .header-icon-box i { font-size: 1.5rem !important; }
            .date-box { font-size: 0.85rem; }
        }
    </style>
</div>