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
    
    <style>
        :root {
            --sidebar-width: 280px;
            --primary-green: #198754;
            --accent-green: #20c997;
            --bg-main: #f4f7f6;
            --bg-card: rgba(255, 255, 255, 0.9);
            --bg-sidebar: linear-gradient(180deg, #198754 0%, #115e3b 100%);
            --text-title: #1e293b;
            --text-body: #475569;
            --glass-border: rgba(255, 255, 255, 0.2);
            --topbar-bg: rgba(255, 255, 255, 0.9);
            --card-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        [data-bs-theme="dark"] {
            --bg-main: #0f172a;
            --bg-card: rgba(30, 41, 59, 0.7);
            --bg-sidebar: #1e293b;
            --text-title: #f8fafc;
            --text-body: #cbd5e1;
            --glass-border: rgba(255, 255, 255, 0.05);
            --topbar-bg: rgba(15, 23, 42, 0.9);
            --card-shadow: 0 15px 40px rgba(0,0,0,0.4);
        }
        
        body {
            background: var(--bg-main);
            color: var(--text-body);
            font-family: 'Outfit', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: var(--bg-sidebar);
            z-index: 1040; 
            display: flex;
            flex-direction: column;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-right: 1px solid var(--glass-border);
        }
        
        .sidebar-header {
            padding: 30px 25px;
            flex-shrink: 0;
        }
        
        .sidebar-menu {
            padding: 10px 15px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .sidebar-menu::-webkit-scrollbar { width: 4px; }
        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            border-radius: 15px;
            margin-bottom: 5px;
            font-weight: 500;
            transition: 0.3s;
        }
        
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }
        
        .sidebar-menu a i {
            margin-right: 15px;
            font-size: 1.2rem;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            flex-shrink: 0;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            /* Padding 0 agar Top Bar menempel ke ujung layar */
            padding: 0; 
            min-height: 100vh;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            width: calc(100% - var(--sidebar-width));
            display: flex;
            flex-direction: column;
        }
        
        /* MODIFIKASI DISINI: Membuat Top Bar Rapat/Full */
        .top-bar {
            background: var(--topbar-bg);
            backdrop-filter: blur(15px);
            /* Menghilangkan radius agar menempel kotak ke ujung */
            border-radius: 0; 
            /* Menghilangkan margin agar tidak mengambang */
            margin-bottom: 25px; 
            padding: 15px 30px;
            border-bottom: 1px solid var(--glass-border);
            border-left: none;
            border-right: none;
            border-top: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            z-index: 1001;
            width: 100%;
            position: sticky;
            top: 0;
        }
        
        /* Padding konten di bawah header agar tetap rapi */
        .content-body {
            padding: 0 30px 30px 30px;
        }
        
        .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background: rgba(128, 128, 128, 0.1);
            color: var(--text-title);
            border: 1px solid var(--glass-border);
        }

        .menu-toggle { 
            display: none; 
            cursor: pointer; 
            font-size: 1.5rem; 
            color: var(--text-title); 
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(4px);
            z-index: 1030;
        }

        @media (max-width: 1200px) {
            .sidebar { 
                left: calc(var(--sidebar-width) * -1); 
            }
            .sidebar.show { 
                left: 0; 
                z-index: 1060; 
            }
            .sidebar.show ~ .sidebar-overlay {
                display: block;
            }
            .main-content { 
                margin-left: 0; 
                width: 100%;
            }
            .content-body {
                padding: 0 20px 20px 20px;
            }
            .menu-toggle { 
                display: block !important; 
            }
        }

        .table-responsive {
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid var(--glass-border);
        }
    </style>
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="d-flex align-items-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 40px; height: 40px; border-radius: 10px; background: white; padding: 5px;">
                <div class="ms-3 text-white">
                    <h5 class="mb-0 fw-bold">Nusantara</h5>
                    <small class="opacity-50">Administrator</small>
                </div>
            </div>
        </div>
        
        <nav class="sidebar-menu">
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
                <small class="text-uppercase text-white-50 fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">Access</small>
            </div>
            
            <a href="{{ route('home.index') }}" target="_blank">
                <i class="bi bi-globe2"></i> Visit Site
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="nav-link text-white-50">
                <i class="bi bi-power me-2"></i> Log Out
            </a>
            <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <div class="main-content">
        <header class="top-bar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="menu-toggle me-3" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold" style="color: var(--text-title)">@yield('page-title', 'Dashboard Overview')</h5>
                    <small class="text-muted">Welcome back, {{ Auth::check() ? Auth::user()->name : 'User' }}</small>
                </div>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <div class="theme-toggle" onclick="toggleTheme()">
                    <i class="bi bi-sun-fill" id="themeIcon"></i>
                </div>
                <div class="vr mx-2 opacity-10"></div>
                
                <div class="dropdown">
                    <div class="d-flex align-items-center gap-3" style="cursor: pointer;" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="text-end d-none d-sm-block">
                            <p class="mb-0 fw-bold" style="color: var(--text-title); font-size: 0.9rem;">{{ Auth::check() ? Auth::user()->name : 'User' }}</p>
                            <small class="text-success" style="font-size: 0.75rem;">Admin</small>
                        </div>
                        <img src="https://ui-avatars.com/api/?name={{ Auth::check() ? Auth::user()->name : 'User' }}&background=198754&color=fff" class="rounded-circle" width="40" height="40">
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2" style="border-radius: 15px; min-width: 200px;">
                        <li>
                            <a class="dropdown-item rounded-3 py-2" href="{{ route('admin.settings') }}">
                                <i class="bi bi-person me-2"></i>Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider opacity-10"></li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </div>
        </header>

        <main class="content-body">
            @yield('content')
        </main>
    </div>

    @stack('modals')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        function setTheme(theme) {
            document.documentElement.setAttribute('data-bs-theme', theme);
            localStorage.setItem('theme', theme);
            const icon = document.getElementById('themeIcon');
            if(theme === 'dark') {
                icon.classList.replace('bi-sun-fill', 'bi-moon-fill');
            } else {
                icon.classList.replace('bi-moon-fill', 'bi-sun-fill');
            }
        }

        function toggleTheme() {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            setTheme(currentTheme === 'dark' ? 'light' : 'dark');
        }

        setTheme(localStorage.getItem('theme') || 'light');

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth > 1200) {
                document.getElementById('sidebar').classList.remove('show');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>