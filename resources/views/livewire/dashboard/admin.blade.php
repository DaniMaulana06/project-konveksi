{{-- Dashboard dengan Toast Notification Real-time & Grafik Statistik --}}
<div>
    <div class="container-fluid p-4">
        {{-- Header Card --}}
        <div class="card border-0 shadow-sm mb-4 header-card">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="header-icon-box rounded-2 p-2 me-2">
                                <i class="fas fa-chart-line text-white fs-2"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-1 text-primary">Dashboard Admin</h3>
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
        
        {{-- 4 Cards Horizontal --}}
        <div wire:poll.3s="checkNewActivity">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3 mb-4">
                <div class="col">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <p class="text-muted small mb-2">Total Order</p>
                            <h2 class="fw-bold text-primary mb-0">{{ $totalOrder }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <p class="text-muted small mb-2">Pending</p>
                            <h2 class="fw-bold text-warning mb-0">{{ $orderPending }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <p class="text-muted small mb-2">Sedang Diproses</p>
                            <h2 class="fw-bold text-info mb-0">{{ $orderProses }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <p class="text-muted small mb-2">Selesai</p>
                            <h2 class="fw-bold text-success mb-0">{{ $orderSelesai }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik Statistik --}}
        <div class="row g-3 mb-4">
            <div class="col-12" wire:ignore>
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-chart-line text-primary me-2"></i>
                            Statistik Total Produksi 6 Bulan Terakhir
                        </h5>
                        <div>
                            <span class="badge bg-primary rounded-pill me-2" id="totalBadge">{{ array_sum($monthlyOrderData) }} Pcs</span>
                            <button onclick="refreshChart()" class="btn btn-sm btn-outline-primary" type="button">
                                <i class="fas fa-sync-alt" id="syncIcon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="position: relative;">
                        <div style="height: 300px; position: relative;">
                            <canvas id="monthlyOrderChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Aktivitas Terbaru --}}
        <div class="row g-3">
            <div class="col-12" wire:poll.3s="checkNewActivity">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-history text-primary me-2"></i>
                            Aktivitas Terbaru
                        </h5>
                        <span class="badge bg-primary rounded-pill">{{ count($aktivitasTerbaru) }}</span>
                    </div>
                    <div class="card-body p-0">
                        @forelse($aktivitasTerbaru as $aktivitas)
                            <div class="aktivitas-item d-flex align-items-start p-3 border-bottom" wire:key="aktivitas-{{ $aktivitas->id }}">
                                <div class="flex-shrink-0 me-3">
                                    <div class="icon-circle bg-{{ $aktivitas->warna }} bg-opacity-10 text-{{ $aktivitas->warna }}">
                                        <i class="fas {{ $aktivitas->icon }}"></i>
                                    </div>
                                </div>

                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-semibold">{{ $aktivitas->judul }}</h6>
                                    @if($aktivitas->deskripsi)
                                        <p class="text-muted small mb-1">{{ $aktivitas->deskripsi }}</p>
                                    @endif
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $aktivitas->created_at->diffForHumans() }}
                                        @if($aktivitas->user)
                                            • oleh <strong>{{ $aktivitas->user->name }}</strong>
                                        @endif
                                    </small>
                                </div>

                                <div class="flex-shrink-0">
                                    <span class="badge bg-{{ $aktivitas->warna }} bg-opacity-10 text-{{ $aktivitas->warna }} rounded-pill px-3">
                                        {{ ucfirst($aktivitas->jenis) }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-5">
                                <i class="fas fa-inbox fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada aktivitas terbaru</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Toast Container --}}
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div id="activityToast" class="toast align-items-center border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
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
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        let chartInstance = null;
        let isChartReady = false;

        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => initMonthlyChart(), 100);
        });

        function refreshChart() {
            const syncIcon = document.getElementById('syncIcon');
            syncIcon.classList.add('fa-spin');
            @this.call('loadMonthlyOrderStats').then(() => syncIcon.classList.remove('fa-spin'));
        }

        document.addEventListener('livewire:init', () => {
            Livewire.on('new-activity', (event) => {
                const data = event[0];
                document.getElementById('toastTitle').textContent = data.judul;
                document.getElementById('toastMessage').textContent = data.deskripsi || 'Aktivitas baru telah ditambahkan';
                
                const iconCircle = document.getElementById('toastIcon');
                iconCircle.querySelector('i').className = 'fas ' + data.icon;
                
                const colorMap = { 'primary': '#0d6efd', 'success': '#198754', 'warning': '#ffc107', 'danger': '#dc3545', 'info': '#0dcaf0' };
                iconCircle.style.backgroundColor = colorMap[data.warna] || colorMap['primary'];
                
                const badgeColors = { 'order': 'bg-primary', 'produksi': 'bg-info', 'produk': 'bg-success', 'bahan': 'bg-warning' };
                document.getElementById('toastBadge').innerHTML = `<span class="badge ${badgeColors[data.jenis] || 'bg-primary'} mt-1">${data.jenis.charAt(0).toUpperCase() + data.jenis.slice(1)}</span>`;
                
                const toast = document.getElementById('activityToast');
                toast.className = 'toast align-items-center border-0 shadow-lg bg-' + data.warna;
                
                new bootstrap.Toast(toast, { autohide: true, delay: 5000 }).show();
            });

            Livewire.on('chart-updated', (event) => {
                const newData = event[0];
                if (chartInstance && newData && isChartReady) {
                    chartInstance.data.labels = newData.labels;
                    chartInstance.data.datasets[0].data = newData.data;
                    chartInstance.update('none');
                    
                    const total = newData.data.reduce((a, b) => a + b, 0);
                    const badge = document.getElementById('totalBadge');
                    if (badge) badge.textContent = total + ' Pcs';
                }
            });
        });

        function initMonthlyChart() {
            const ctx = document.getElementById('monthlyOrderChart');
            if (!ctx) {
                setTimeout(initMonthlyChart, 200);
                return;
            }

            if (chartInstance && isChartReady) return;

            if (chartInstance) {
                chartInstance.destroy();
                chartInstance = null;
            }

            const labels = @json($monthlyLabels);
            const data = @json($monthlyOrderData);

            chartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Produksi (Pcs)',
                        data: data,
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
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 13 },
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
                            ticks: { stepSize: 50, font: { size: 12 } },
                            grid: { color: 'rgba(0, 0, 0, 0.05)' }
                        },
                        x: {
                            ticks: { font: { size: 12 } },
                            grid: { display: false }
                        }
                    }
                }
            });

            isChartReady = true;
        }
    </script>

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

        .toast.bg-success { background-color: rgba(25, 135, 84, 0.95) !important; color: white; }
        .toast.bg-primary { background-color: rgba(13, 110, 253, 0.95) !important; color: white; }
        .toast.bg-warning { background-color: rgba(255, 193, 7, 0.95) !important; color: #000; }
        .toast.bg-info { background-color: rgba(13, 202, 240, 0.95) !important; color: #000; }
        .toast.bg-danger { background-color: rgba(220, 53, 69, 0.95) !important; color: white; }

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

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        
        .card-body h2 { font-size: 2.5rem; }

        .icon-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .aktivitas-item {
            transition: background-color 0.2s ease;
        }

        .aktivitas-item:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .aktivitas-item:last-child {
            border-bottom: none !important;
        }

        .bg-primary.bg-opacity-10 { background-color: rgba(13, 110, 253, 0.1) !important; }
        .bg-success.bg-opacity-10 { background-color: rgba(25, 135, 84, 0.1) !important; }
        .bg-warning.bg-opacity-10 { background-color: rgba(255, 193, 7, 0.1) !important; }
        .bg-danger.bg-opacity-10 { background-color: rgba(220, 53, 69, 0.1) !important; }
        .bg-info.bg-opacity-10 { background-color: rgba(13, 202, 240, 0.1) !important; }

        @media (max-width: 576px) {
            .card-body h2 { font-size: 2rem; }
            h1 { font-size: 1.5rem; }
            .header-icon-box { width: 50px; height: 50px; }
            .header-icon-box i { font-size: 1.5rem !important; }
            .date-box { font-size: 0.85rem; }
        }
    </style>
</div>