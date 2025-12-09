@section('title', 'Dashboard Owner')

{{-- Dashboard dengan Toast Notification Real-time & Grafik Statistik --}}
<div>
    @push('styles')
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
                width: 60px;
                height: 60px;
                display: flex;
                align-items: center;
                justify-content: center;
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

            .toast {
                border-radius: 12px !important;
                backdrop-filter: blur(10px);
            }

            .toast.bg-success {
                background-color: rgba(25, 135, 84, 0.95) !important;
                color: white;
            }

            .toast.bg-primary {
                background-color: rgba(13, 110, 253, 0.95) !important;
                color: white;
            }

            .toast.bg-warning {
                background-color: rgba(255, 193, 7, 0.95) !important;
                color: #000;
            }

            .toast.bg-info {
                background-color: rgba(13, 202, 240, 0.95) !important;
                color: white;
            }

            .toast.bg-danger {
                background-color: rgba(220, 53, 69, 0.95) !important;
                color: white;
            }

            .icon-circle-toast {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                background-color: rgba(255, 255, 255, 0.3);
                color: white;
            }


            .card-body h2 {
                font-size: 2.5rem;
            }

            #monthlyOrderChart {
                width: 100% !important;
                height: 350px !important;
            }

            .bg-primary-subtle {
                background-color: rgba(13, 110, 253, 0.1) !important;
            }

            .bg-success-subtle {
                background-color: rgba(25, 135, 84, 0.1) !important;
            }

            .bg-warning-subtle {
                background-color: rgba(255, 193, 7, 0.1) !important;
            }

            .bg-info-subtle {
                background-color: rgba(13, 202, 240, 0.1) !important;
            }

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

            @media (max-width: 576px) {
                .card-body h2 {
                    font-size: 2rem;
                }

                h1 {
                    font-size: 1.5rem;
                }

                .header-icon-box {
                    width: 50px;
                    height: 50px;
                }

                .header-icon-box i {
                    font-size: 1.5rem !important;
                }

                .date-box {
                    font-size: 0.85rem;
                }

                .icon-box {
                    width: 50px;
                    height: 50px;
                }
            }
        </style>
    @endpush

    <div class="container-fluid p-4">
        {{-- Header Card --}}
        <div class="card border-0 shadow-sm mb-4 header-card rounded-4">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="header-icon-box rounded-4 p-2 me-2">
                                <i class="fas fa-chart-line text-primary fs-2"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-1 text-primary">Dashboard Admin</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <div class="d-flex align-items-center justify-content-md-end">
                            <div class="date-box bg-light rounded-4 p-3">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                <span
                                    class="fw-semibold">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Order Cards --}}
        <div wire:poll.3s="checkNewActivity">
            <div class="row g-3 mb-4">
                <div class="col-6 col-md-4 col-lg">
                    <div class="card border-0 shadow-sm h-100 card-hover rounded-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="icon-box bg-primary bg-opacity-10 rounded-4 p-3">
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
                    <div class="card border-0 shadow-sm h-100 card-hover rounded-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="icon-box bg-warning bg-opacity-10 rounded-4 p-3">
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
                    <div class="card border-0 shadow-sm h-100 card-hover rounded-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="icon-box bg-info bg-opacity-10 rounded-4 p-3">
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
                    <div class="card border-0 shadow-sm h-100 card-hover rounded-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="icon-box bg-success bg-opacity-10 rounded-4 p-3">
                                    <i class="fas fa-check-circle text-success fs-4"></i>
                                </div>
                                <span class="badge bg-success-subtle text-success">Selesai</span>
                            </div>
                            <h3 class="fw-bold text-dark mb-1">{{ $orderSelesai ?? 0 }}</h3>
                            <p class="text-muted small mb-0">Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik Statistik --}}
        <div class="row g-3 mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4" wire:ignore>
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3 rounded-4">
                        <h5 class="fw-bold mb-0 text-primary">
                            <i class="fas fa-chart-line text-primary me-2"></i>
                            Statistik Total Produksi 6 Bulan Terakhir
                        </h5>
                        <div>
                            <span class="badge bg-primary rounded-pill me-2"
                                id="totalBadge">{{ array_sum($monthlyOrderData ?? [0]) }} Pcs</span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div style="position: relative; height: 350px;">
                            <canvas id="monthlyOrderChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Top Produk --}}
        <div class="row g-3 mb-4">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 py-3 rounded-4">
                        <div class="d-flex justify-content-between align-items-center mt-3 ms-3 me-3">
                            <h5 class="fw-bold text-primary">
                                <i class="fas fa-fire text-danger me-2"></i>Top 5 Barang Paling Sering Diproduksi
                            </h5>
                            <button wire:click="refreshActivities" class="btn btn-sm btn-outline-primary float-end"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="refreshActivities"><i
                                        class="fas fa-sync-alt me-1"></i> Refresh</span>
                                <span wire:loading wire:target="refreshActivities"><i
                                        class="fas fa-spinner fa-spin me-1"></i> Refreshing...</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body py-4">
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
                                                @if ($index == 0)
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
                                                    <span
                                                        class="badge bg-light text-dark fs-6 px-3 py-2">#{{ $index + 1 }}</span>
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
                                                <strong class="text-success">{{ $product['total_quantity'] }}
                                                    pcs</strong>
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

    {{-- Toast Container --}}
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div id="activityToast" class="toast align-items-center border-0 shadow-lg" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-start" style="min-width: 300px;">
                    <div class="flex-shrink-0 me-3">
                        <div class="icon-circle-toast" id="toastIcon">
                            <i class="fas fa-bell"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1 fw-bold" id="toastTitle">Aktivitas Baru</h6>
                        <p class="mb-0 small text-muted" id="toastMessage">Ada aktivitas baru</p>
                        <small class="text-muted" id="toastBadge">
                            <span class="badge bg-primary mt-1">Order</span>
                        </small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    {{-- Scripts untuk Chart --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
        // Data dari backend
        const chartLabels = {!! json_encode($monthlyLabels ?? ['Jun 2025', 'Jul 2025', 'Aug 2025', 'Sep 2025', 'Oct 2025', 'Nov 2025']) !!};
        const chartData = {!! json_encode($monthlyOrderData ?? [10, 20, 15, 30, 25, 137]) !!};

        console.log('📊 Chart Data:', {
            labels: chartLabels,
            data: chartData
        });

        let myChart = null;
        let isChartInitialized = false;

        function createChart() {
            const canvas = document.getElementById('monthlyOrderChart');

            if (!canvas) {
                console.error('❌ Canvas tidak ditemukan!');
                return;
            }

            if (typeof Chart === 'undefined') {
                console.error('❌ Chart.js tidak ter-load!');
                alert('Chart.js tidak ter-load! Periksa koneksi internet atau CDN.');
                return;
            }

            // Cegah re-render jika chart sudah ada
            if (isChartInitialized && myChart) {
                console.log('⚠️ Chart sudah ada, skip re-render');
                return;
            }

            console.log('✅ Canvas ditemukan, Chart.js siap');

            // Destroy chart lama jika ada
            if (myChart) {
                myChart.destroy();
                myChart = null;
            }

            // Buat chart baru
            const ctx = canvas.getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Total Produksi (Pcs)',
                        data: chartData,
                        backgroundColor: 'rgba(13, 110, 253, 0.8)',
                        borderColor: 'rgba(13, 110, 253, 1)',
                        borderWidth: 2,
                        borderRadius: 8,
                        hoverBackgroundColor: 'rgba(13, 110, 253, 1)',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            },
                            callbacks: {
                                label: function(context) {
                                    return 'Total Produksi: ' + context.parsed.y + ' Pcs';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 20,
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            isChartInitialized = true;
            console.log('✅✅✅ Chart berhasil dibuat!');
        }

        function refreshChart() {
            const icon = document.getElementById('syncIcon');
            if (icon) icon.classList.add('fa-spin');

            // Update data chart jika ada, jangan buat ulang
            if (myChart) {
                myChart.update('none'); // Update tanpa animasi
            }

            setTimeout(() => {
                if (icon) icon.classList.remove('fa-spin');
            }, 500);
        }

        // Inisialisasi chart HANYA SEKALI
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(createChart, 100);
            });
        } else {
            setTimeout(createChart, 100);
        }

        // Livewire integration
        if (typeof Livewire !== 'undefined') {
            document.addEventListener('livewire:init', () => {
                Livewire.on('new-activity', (event) => {
                    const data = event[0];
                    document.getElementById('toastTitle').textContent = data.judul;
                    document.getElementById('toastMessage').textContent = data.deskripsi ||
                        'Aktivitas baru';

                    const toast = document.getElementById('activityToast');
                    toast.className = 'toast align-items-center border-0 shadow-lg bg-' + data.warna;
                    new bootstrap.Toast(toast, {
                        autohide: true,
                        delay: 5000
                    }).show();
                });

                Livewire.on('chart-updated', (event) => {
                    const newData = event[0];
                    if (newData && myChart) {
                        myChart.data.labels = newData.labels;
                        myChart.data.datasets[0].data = newData.data;
                        myChart.update();

                        const total = newData.data.reduce((a, b) => a + b, 0);
                        document.getElementById('totalBadge').textContent = total + ' Pcs';
                    }
                });
            });
        }
    </script>
</div>
