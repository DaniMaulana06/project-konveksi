<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="margin: 0; padding: 0; overflow-x: hidden;">
    @auth
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h5 class="sidebar-title">Konveksi Pelajar</h5>
                <button class="btn-collapse" id="collapseBtn" onclick="toggleSidebar()">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>

            <ul class="sidebar-nav">
                @if (Auth::user()->role === 'admin')
                    <!-- Admin Section -->
                    <div class="nav-item">
                        <a href="/admin/dashboard" class="{{ request()->routeIs('dashboard.admin') ? 'active' : '' }}"
                            title="Dashboard">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </div>
                    <li class="nav-section">

                        <div class="nav-section-title">Admin</div>
                        <div class="nav-item">
                            <a href="{{ route('order.index') }}" class="{{ request()->routeIs('order*') ? 'active' : '' }}"
                                title="Order">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="nav-text">Order</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('product.index') }}"
                                class="{{ request()->routeIs('product*') ? 'active' : '' }}" title="Produk">
                                <i class="fas fa-box"></i>
                                <span class="nav-text">Produk</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('vendor.index') }}"
                                class="{{ request()->routeIs('vendor*') ? 'active' : '' }}" title="Vendor">
                                <i class="fas fa-store"></i>
                                <span class="nav-text">Vendor</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="/kategori" class="{{ request()->routeIs('category*') ? 'active' : '' }}"
                                title="Kategori">
                                <i class="fas fa-list-alt"></i>
                                <span class="nav-text">Kategori</span>
                            </a>
                        </div>
                    </li>
                @elseif (Auth::user()->role === 'produksi')
                    <!-- Production Section -->
                    <div class="nav-item">
                        <a href="/produksi/dashboard"
                            class="{{ request()->routeIs(patterns: 'dashboard.produksi') ? 'active' : '' }}"
                            title="Dashboard">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </div>
                    <li class="nav-section">
                        <div class="nav-section-title">Produksi</div>
                        <div class="nav-item">
                            <a href="/bahan" class="{{ request()->routeIs('bahan*') ? 'active' : '' }}" title="Bahan">
                                <i class="fas fa-cubes"></i>
                                <span class="nav-text">Bahan</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('production.index') }}"
                                class="{{ request()->routeIs('production*') ? 'active' : '' }}" title="Produksi"
                                wire:navigate>
                                <i class="fas fa-industry"></i>
                                <span class="nav-text">Produksi</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="/vendor/list" class="{{ request()->routeIs('vendor*') ? 'active' : '' }}"
                                title="Vendor">
                                <i class="fas fa-store"></i>
                                <span class="nav-text">Vendor</span>
                            </a>
                        </div>
                    </li>
                @elseif(Auth::user()->role === 'owner')
                    <div class="nav-item">
                        <a href="/owner/dashboard"
                            class="{{ request()->routeIs(patterns: 'dashboard.owner') ? 'active' : '' }}"
                            title="Dashboard">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </div>
                    <li class="nav-section">
                        <div class="nav-section-title">Owner</div>
                        <div class="nav-item">
                            <a href="/owner/vendor" class="{{ request()->routeIs('owner.vendor') ? 'active' : '' }}"
                                title="Vendor">
                                <i class="fas fa-store"></i>
                                <span class="nav-text">Vendor</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="/owner/kategori" class="{{ request()->routeIs('owner.kategori') ? 'active' : '' }}"
                                title="Kategori">
                                <i class="fas fa-list-alt"></i>
                                <span class="nav-text">Kategori</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="/owner/produk" class="{{ request()->routeIs('owner.produk') ? 'active' : '' }}"
                                title="Produk">
                                <i class="fas fa-box"></i>
                                <span class="nav-text">Produk</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="/owner/order" class="{{ request()->routeIs('owner.order') ? 'active' : '' }}"
                                title="Order">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="nav-text">Order</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('owner.user.index') }}"
                                class="{{ request()->routeIs('owner.user*') ? 'active' : '' }}" title="Manajemen User">
                                <i class="fas fa-user"></i>
                                <span class="nav-text">Manajemen User</span>
                            </a>
                        </div>
                    </li>
                @endif
            </ul>
        </aside>

        <!-- Main Wrapper -->
        <div class="main-wrapper" id="mainWrapper">
            <!-- Top Navbar -->
            <nav class="top-navbar navbar-expand-lg fixed-top">
                <div class="navbar-left">
                    <button class="btn-menu-toggle d-lg-none" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="user-info d-flex justify-content-between align-items-center w-100">
                    <!-- CUACA (KIRI) -->
                    <div class="fw-bold">
                        {{ $cuacaNavbar['kota'] }} | {{ $cuacaNavbar['suhu'] }}°C
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <span class="user-name fw-bold">Halo, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm logout-btn">Logout</button>
                        </form>
                    </div>
            </nav>

            <!-- Content Area -->
            <div class="content">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <footer class=" text-center text-muted py-2 mt-2 shadow-m">
                <div class="container">
                    <p class="mb-0">&copy; {{ date('Y') }} Konveksi Pelajar. All rights reserved.</p>
                </div>
            </footer>
        </div>
    @else
        <!-- Jika user belum login, hanya tampilkan content tanpa navbar -->
        <div style="width: 100%; height: 100vh; margin: 0; padding: 0; overflow: hidden;">
            {{ $slot }}
        </div>
    @endauth

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    @stack('scripts')
</body>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainWrapper = document.getElementById('mainWrapper');

        sidebar.classList.toggle('collapsed');
        mainWrapper.classList.toggle('expanded');

        // Simpan state ke localStorage
        const isCollapsed = sidebar.classList.contains('collapsed');
        localStorage.setItem('sidebarCollapsed', isCollapsed);
    }

    // Restore sidebar state dari localStorage
    document.addEventListener('DOMContentLoaded', function() {
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        if (isCollapsed) {
            const sidebar = document.getElementById('sidebar');
            const mainWrapper = document.getElementById('mainWrapper');
            sidebar.classList.add('collapsed');
            mainWrapper.classList.add('expanded');
        }
    });
</script>

</html>
