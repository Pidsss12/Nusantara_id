<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NusantaraGreen - @yield('title', 'Dashboard')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <link href="https://fonts.bunny.net/css?family=Outfit:300,400,600,700" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --sidebar-width: 280px;
            --primary-green: #198754;
            --accent-green: #20c997;
            --bg-main: #edf2f7;
            --bg-card: rgba(255, 255, 255, 1);
            --bg-sidebar: linear-gradient(180deg, #198754 0%, #115e3b 100%);
            --text-title: #1e293b;
            --text-body: #475569;
            --glass-border: rgba(255, 255, 255, 0.6);
            --card-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        
        body {
            background: var(--bg-main);
            background-image: 
                radial-gradient(at 0% 0%, rgba(25, 135, 84, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(32, 201, 151, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--text-body);
            font-family: 'Outfit', sans-serif;
            margin: 0;
        }
        
        /* FIX: Sidebar Full ke Samping (Gak Ngambang) */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: var(--bg-sidebar);
            z-index: 1050;
            display: flex;
            flex-direction: column;
            border-radius: 0; /* Menghilangkan sudut bulat agar full nempel */
            box-shadow: 5px 0 25px rgba(0,0,0,0.1);
            overflow: hidden;
            border-right: 1px solid rgba(255,255,255,0.1);
            transition: all 0.4s;
        }
        
        .sidebar-header {
            padding: 30px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            flex-shrink: 0;
        }
        
        .sidebar-menu {
            padding: 20px 12px;
            overflow-y: auto;
            flex: 1;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s;
            border-radius: 12px;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.12);
            color: white;
        }
        
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.2) !important;
            color: white !important;
            font-weight: 700;
            border-left: 4px solid #20c997;
        }
        
        .sidebar-menu a i {
            margin-right: 15px;
            font-size: 1.2rem;
        }
        
        /* FIX: Main content mengikuti sidebar yang nempel */
        .main-content {
            margin-left: var(--sidebar-width);
            height: 100vh;
            overflow-y: auto;
            position: relative;
        }
        
        .top-bar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 20px 30px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .content-area {
            padding: 30px;
        }
        
        .premium-card {
            background: var(--bg-card);
            border: 1px solid rgba(0,0,0,0.03);
            border-radius: 25px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s;
        }

        /* Pagination Style */
        .pagination { gap: 10px; justify-content: center; margin-top: 20px; }
        .page-item .page-link {
            width: 42px; height: 42px; display: flex; align-items: center; justify-content: center;
            border-radius: 50% !important; background: var(--bg-card); border: 1px solid var(--glass-border);
            color: var(--text-body); font-weight: 600; transition: all 0.3s;
        }
        .page-item.active .page-link {
            background: var(--primary-green) !important; color: white !important; transform: scale(1.1);
        }

        /* Responsive Mobile */
        @media (max-width: 991.98px) {
            .sidebar { left: -100%; }
            .main-content { margin-left: 0; }
            .sidebar.show { left: 0; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="d-flex align-items-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 45px; height: 45px; border-radius: 15px; background: white; padding: 5px;">
                <div class="ms-3">
                    <h5 class="mb-0 text-white fw-bold">Nusantara</h5>
                    <small style="color: rgba(255,255,255,0.5)">User Panel</small>
                </div>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <a href="{{ route('user.dashboard') }}" class="{{ Request::is('user/dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('user.bookings') }}" class="{{ Request::is('user/bookings') ? 'active' : '' }}">
                <i class="bi bi-calendar-check"></i> My Bookings
            </a>
            <a href="{{ route('user.invoices') }}" class="{{ Request::is('user/invoices*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> My Invoices
            </a>
            <a href="{{ route('user.profile') }}" class="{{ Request::is('user/profile') ? 'active' : '' }}">
                <i class="bi bi-person"></i> Profile
            </a>
            
            <hr class="border-white opacity-25 mx-3">
            
            <a href="{{ route('destinations.index') }}">
                <i class="bi bi-compass"></i> Explore Destinations
            </a>
            <a href="{{ route('home.index') }}">
                <i class="bi bi-house"></i> Back to Website
            </a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    
    <div class="main-content">
        <div class="top-bar">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0 fw-bold" style="color: var(--text-title)">@yield('page-title', 'Dashboard')</h4>
                    <small class="text-muted">@yield('page-subtitle', 'Welcome back, ' . Auth::user()->name)</small>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="dropdown">
                        <div class="d-flex align-items-center gap-3" style="cursor: pointer;" data-bs-toggle="dropdown">
                            <div class="text-end d-none d-sm-block">
                                <p class="mb-0 fw-bold" style="color: var(--text-title); font-size: 0.9rem;">{{ Auth::user()->name }}</p>
                                <small class="text-success" style="font-size: 0.75rem;">Premium Member</small>
                            </div>
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=198754&color=fff" 
                                 class="rounded-pill" width="40" height="40" alt="Avatar">
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end border-0 premium-card shadow mt-3 p-2">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="#" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-area">
            @yield('content')
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <script>
        // Global SweetAlert logic
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Success!', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Error!', text: "{{ session('error') }}", confirmButtonColor: '#198754' });
        @endif
    </script>
    @yield('scripts')
</body>
</html>