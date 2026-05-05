<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NusantaraGreen - @yield('title', 'Admin Dashboard')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://fonts.bunny.net/css?family=Outfit:300,400,600,700" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        :root {
            --sidebar-width: 280px;
            --primary-green: #198754;
            --accent-green: #20c997;
            
            /* Light Theme Variables */
            --bg-main: #f4f7f6;
            --bg-card: rgba(255, 255, 255, 0.9);
            --bg-sidebar: linear-gradient(180deg, #198754 0%, #115e3b 100%);
            --text-title: #1e293b;
            --text-body: #475569;
            --text-muted: #94a3b8;
            --glass-border: rgba(255, 255, 255, 0.4);
            --topbar-bg: rgba(255, 255, 255, 0.8);
            --card-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        [data-bs-theme="dark"] {
            --bg-main: #0f172a;
            --bg-card: rgba(30, 41, 59, 0.7);
            --bg-sidebar: rgba(15, 23, 42, 0.95);
            --text-title: #f8fafc;
            --text-body: #cbd5e1;
            --text-muted: #64748b;
            --glass-border: rgba(255, 255, 255, 0.05);
            --topbar-bg: rgba(15, 23, 42, 0.8);
            --card-shadow: 0 15px 40px rgba(0,0,0,0.4);
        }
        
        body {
            background: var(--bg-main);
            color: var(--text-body);
            font-family: 'Outfit', sans-serif;
            transition: background 0.3s, color 0.3s;
            overflow-x: hidden;
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 20px;
            left: 20px;
            bottom: 20px;
            width: var(--sidebar-width);
            background: var(--bg-sidebar);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            box-shadow: 10px 0 40px rgba(0,0,0,0.1);
            z-index: 1050;
            overflow-y: auto;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--glass-border);
        }
        
        .sidebar-header {
            padding: 35px 25px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-menu {
            padding: 30px 15px;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 18px;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,0.15);
            color: white;
            transform: translateX(5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .sidebar-menu a i {
            margin-right: 15px;
            font-size: 1.3rem;
            transition: 0.3s;
        }

        .sidebar-menu a:hover i {
            transform: scale(1.1);
            color: var(--accent-green);
        }
        
        /* Main Content area */
        .main-content {
            margin-left: calc(var(--sidebar-width) + 60px);
            padding: 20px 40px 40px 0;
            min-height: 100vh;
            transition: margin 0.4s;
        }
        
        .top-bar {
            background: var(--topbar-bg);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 15px 30px;
            margin-bottom: 35px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--card-shadow);
            position: sticky;
            top: 20px;
            z-index: 999;
        }
        
        /* Premium Components */
        .premium-card {
            background: var(--bg-card);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s;
        }

        .premium-card:hover {
            transform: translateY(-8px);
        }

        .theme-toggle {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background: rgba(128, 128, 128, 0.1);
            color: var(--text-title);
            border: 1px solid var(--glass-border);
            transition: 0.3s;
        }

        .theme-toggle:hover {
            background: var(--primary-green);
            color: white;
        }

        /* Mobile Hamburger */
        .menu-toggle {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            margin-right: 15px;
            color: var(--text-title);
        }

        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .sidebar {
                left: -320px;
            }
            .sidebar.show {
                left: 20px;
            }
            .main-content {
                margin-left: 20px;
                padding-right: 20px;
            }
            .menu-toggle {
                display: block;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(128, 128, 128, 0.3);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-green);
        }

        /* Premium Pagination */
        .pagination {
            gap: 10px;
            border: none;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .page-item .page-link {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50% !important;
            background: var(--bg-card);
            border: 1px solid var(--glass-border);
            color: var(--text-body);
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--card-shadow);
        }
        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%) !important;
            border-color: transparent !important;
            color: white !important;
            box-shadow: 0 8px 20px rgba(25, 135, 84, 0.4);
            transform: scale(1.1);
        }
        .page-item .page-link:hover {
            background: var(--accent-green);
            color: white;
            transform: translateY(-3px) scale(1.05);
            border-color: transparent;
        }
        .page-item.disabled .page-link {
            background: rgba(128, 128, 128, 0.05);
            color: var(--text-muted);
            border-color: var(--glass-border);
        }

        /* Card Footer Fixes */
        .card-footer {
            background: transparent !important;
            border-top: 1px solid var(--glass-border) !important;
            padding: 20px !important;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="d-flex align-items-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 45px; height: 45px; border-radius: 15px; background: white; padding: 5px;">
                <div class="ms-3">
                    <h5 class="mb-0 text-white fw-bold">Nusantara</h5>
                    <small style="color: rgba(255,255,255,0.5)">Admin Dashboard</small>
                </div>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Overview
            </a>
            <a href="{{ route('admin.destinations') }}" class="{{ request()->routeIs('admin.destinations*') ? 'active' : '' }}">
                <i class="bi bi-pin-map-fill"></i> Destinations
            </a>
            <a href="{{ route('admin.bookings') }}" class="{{ request()->routeIs('admin.bookings*') ? 'active' : '' }}">
                <i class="bi bi-journal-bookmark-fill"></i> Bookings
            </a>
            <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Customers
            </a>
            <a href="{{ route('admin.packages') }}" class="{{ request()->routeIs('admin.packages*') ? 'active' : '' }}">
                <i class="bi bi-box-seam-fill"></i> Packages
            </a>
            <a href="{{ route('admin.reports') }}" class="{{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-fill"></i> Analytics
            </a>
            <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <i class="bi bi-gear-fill"></i> Settings
            </a>
            
            <div class="mt-4 mb-2 mx-3">
                <small class="text-uppercase" style="color: rgba(255,255,255,0.3); font-size: 0.7rem; font-weight: 700; letter-spacing: 1px;">Access</small>
            </div>
            
            <a href="{{ route('home.index') }}" target="_blank">
                <i class="bi bi-globe2"></i> Visit Site
            </a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-danger-emphasis">
                <i class="bi bi-power"></i> Log Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="menu-toggle" onclick="toggleSidebar()">
                        <i class="bi bi-list"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold" style="color: var(--text-title)">@yield('page-title', 'Overview')</h4>
                        <small class="text-muted">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="theme-toggle" id="themeToggle" onclick="toggleTheme()">
                        <i class="bi bi-sun-fill" id="themeIcon"></i>
                    </div>
                    
                    <div class="vr mx-2 opacity-10"></div>
                    
                    <div class="dropdown">
                        <div class="d-flex align-items-center gap-3" style="cursor: pointer;" data-bs-toggle="dropdown">
                            <div class="text-end d-none d-sm-block">
                                <p class="mb-0 fw-bold" style="color: var(--text-title); font-size: 0.9rem;">{{ Auth::user()->name }}</p>
                                <small class="text-success" style="font-size: 0.75rem;">Administrator</small>
                            </div>
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=198754&color=fff" 
                                 class="rounded-pill" width="40" height="40" alt="Avatar">
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end border-0 premium-card shadow mt-3 p-2">
                            <li><a class="dropdown-item rounded-3 p-2" href="#"><i class="bi bi-person me-2"></i>My Profile</a></li>
                            <li><a class="dropdown-item rounded-3 p-2" href="#"><i class="bi bi-shield-lock me-2"></i>Security</a></li>
                            <li><hr class="dropdown-divider opacity-10"></li>
                            <li>
                                <a class="dropdown-item rounded-3 p-2 text-danger" href="#" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Content -->
        <div class="container-fluid p-0">
            @yield('content')
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Theme Logic
        function setTheme(theme) {
            document.documentElement.setAttribute('data-bs-theme', theme);
            localStorage.setItem('theme', theme);
            const icon = document.getElementById('themeIcon');
            if (theme === 'dark') {
                icon.classList.replace('bi-sun-fill', 'bi-moon-fill');
            } else {
                icon.classList.replace('bi-moon-fill', 'bi-sun-fill');
            }
            // Notify charts if any
            if (typeof updateChartsTheme === 'function') updateChartsTheme(theme);
        }

        function toggleTheme() {
            const current = document.documentElement.getAttribute('data-bs-theme');
            setTheme(current === 'dark' ? 'light' : 'dark');
        }

        // Initialize Theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);

        // Sidebar Logic
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }

        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.querySelector('.menu-toggle');
            if (window.innerWidth <= 1200 && 
                !sidebar.contains(event.target) && 
                !menuToggle.contains(event.target) &&
                sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });

        // Global SweetAlert2 Session Handling
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: 'rgba(255, 255, 255, 0.95)',
                backdrop: `rgba(25, 135, 84, 0.1)`,
                customClass: {
                    popup: 'premium-card',
                    title: 'fw-bold text-success'
                }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#198754',
                background: 'rgba(255, 255, 255, 0.95)',
                customClass: {
                    popup: 'premium-card',
                    title: 'fw-bold text-danger'
                }
            });
        @endif
    </script>
    @yield('scripts')
</body>
</html>
