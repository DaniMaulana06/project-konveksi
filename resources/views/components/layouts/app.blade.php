<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @livewireStyles
    @livewireScripts
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
</head>

<body>
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
                <!-- Admin Section -->
                <li class="nav-section">
                    <div class="nav-section-title">Admin</div>
                    <div class="nav-item">
                        <a href="/order" class="{{ request()->routeIs('order*') ? 'active' : '' }}" title="Order">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="nav-text">Order</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="/product" class="{{ request()->routeIs('product*') ? 'active' : '' }}" title="Produk">
                            <i class="fas fa-box"></i>
                            <span class="nav-text">Produk</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="/vendor" class="{{ request()->routeIs('vendor*') ? 'active' : '' }}" title="Vendor">
                            <i class="fas fa-store"></i>
                            <span class="nav-text">Vendor</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="/kategori" class="{{ request()->routeIs('category*') ? 'active' : '' }}" title="Kategori">
                            <i class="fas fa-list-alt"></i>
                            <span class="nav-text">Kategori</span>
                        </a>
                    </div>
                </li>

                <!-- Production Section -->
                <li class="nav-section">
                    <div class="nav-section-title">Produksi</div>
                    <div class="nav-item">
                        <a href="/bahan" class="{{ request()->routeIs('bahan*') ? 'active' : '' }}" title="Bahan">
                            <i class="fas fa-cubes"></i>
                            <span class="nav-text">Bahan</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="/produksi" class="{{ request()->routeIs('produksi*') ? 'active' : '' }}" title="Produksi">
                            <i class="fas fa-industry"></i>
                            <span class="nav-text">Produksi</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="/vendor" class="{{ request()->routeIs('vendor*') ? 'active' : '' }}" title="Vendor">
                            <i class="fas fa-store"></i>
                            <span class="nav-text">Vendor</span>
                        </a>
                    </div>
                </li>
            </ul>
        </aside>

        <!-- Main Wrapper -->
        <div class="main-wrapper" id="mainWrapper">
            <!-- Top Navbar -->
            <nav class="top-navbar">
                <div class="navbar-left">
                    <button class="btn-menu-toggle d-lg-none" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="user-info">
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
        </div>
    @else
        <!-- Jika user belum login, hanya tampilkan content tanpa navbar -->
        <div style="width: 100%; padding: 20px;">
            {{ $slot }}
        </div>
    @endauth

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
</body>

</html>