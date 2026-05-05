<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NusantaraGreen - @yield('title', 'Ekowisata Indonesia')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Outfit:400,600,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Outfit', sans-serif; 
            padding-top: 80px;
            margin: 0;
        }
        
        main {
            margin: 0;
            padding: 0;
        }
        
        #main-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 80px;
            background: linear-gradient(135deg, #198754 0%, #146c43 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 9999;
            border: none;
            border-bottom: none;
        }
        
        #header-content {
            max-width: 1400px;
            margin: 0 auto;
            height: 100%;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        #brand-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
        }
        
        #brand-logo img {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: white;
            padding: 6px;
            object-fit: contain;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            display: block;
        }
        
        #brand-text {
            display: flex;
            flex-direction: column;
        }
        
        #brand-name {
            font-size: 24px;
            font-weight: 700;
            color: white;
            line-height: 1;
        }
        
        #brand-rating {
            font-size: 14px;
            color: #ffc107;
            font-weight: 600;
        }
        
        #main-menu {
            display: flex;
            list-style: none;
            gap: 10px;
            align-items: center;
        }
        
        .menu-link {
            padding: 10px 24px;
            border-radius: 25px;
            background: rgba(255,255,255,0.15);
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        .menu-link:hover {
            background: white;
            color: #198754;
        }
        
        .menu-link.active {
            background: white;
            color: #198754;
        }
        
        #auth-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .btn-login {
            padding: 10px 24px;
            border-radius: 25px;
            background: transparent;
            border: 2px solid white;
            color: white;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background: white;
            color: #198754;
        }
        
        .btn-register {
            padding: 10px 24px;
            border-radius: 25px;
            background: white;
            color: #198754;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        /* Custom Aesthetic Pagination */
        .pagination {
            gap: 8px;
            margin-top: 20px;
        }
        
        .page-item .page-link {
            border: none;
            border-radius: 12px !important;
            padding: 8px 16px;
            color: #198754;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            background: white;
            min-width: 42px;
            text-align: center;
        }
        
        .page-item.active .page-link {
            background: linear-gradient(135deg, #198754 0%, #146c43 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(25, 135, 84, 0.3);
        }
        
        .page-item .page-link:hover:not(.active) {
            background: #e9ecef;
            transform: translateY(-2px);
            color: #146c43;
        }
        
        .page-item.disabled .page-link {
            background: #f8f9fa;
            color: #adb5bd;
            box-shadow: none;
        }
    </style>
</head>
<body>
    <header id="main-header">
        <div id="header-content">
            <a href="{{ url('/') }}" id="brand-logo">
                <img src="{{ asset('img/logo.png') }}" alt="Logo">
                <div id="brand-text">
                    <span id="brand-name">NusantaraGreen</span>
                    <span id="brand-rating"><i class="bi bi-star-fill"></i> 4.9</span>
                </div>
            </a>
            
            <nav>
                <ul id="main-menu">
                    <li><a href="{{ route('home.index') }}" class="menu-link {{ Request::is('/') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('destinations.index') }}" class="menu-link {{ Request::is('destinations*') ? 'active' : '' }}">Wisata</a></li>
                    <li><a href="{{ route('education') }}" class="menu-link {{ Request::is('education') ? 'active' : '' }}">Paket Edukasi</a></li>
                    <li><a href="{{ route('invoice.check') }}" class="menu-link {{ Request::is('invoice*') ? 'active' : '' }}">Cek Invoice</a></li>
                    <li><a href="{{ route('about') }}" class="menu-link {{ Request::is('about') ? 'active' : '' }}">Tentang</a></li>
                </ul>
            </nav>
            
            <div id="auth-buttons">
                @guest
                    <a href="{{ route('login') }}" class="btn-login">Login</a>
                    <a href="{{ route('register') }}" class="btn-register">Register</a>
                @else
                    @if(Auth::user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn-login" style="background: rgba(255,255,255,0.2);">
                        <i class="bi bi-speedometer2 me-1"></i>Admin
                    </a>
                    @endif
                    <a href="{{ route('user.dashboard') }}" class="btn-register">
                        <i class="bi bi-grid me-1"></i>Dashboard
                    </a>
                    <a href="{{ route('logout') }}" class="btn-login" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                @endguest
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
    
    <!-- Footer Copyright -->
    <footer style="background: #198754; color: white; padding: 30px 0;">
        <div style="max-width: 1400px; margin: 0 auto; padding: 0 30px; text-align: center;">
            <p style="margin: 0; font-size: 14px; opacity: 0.9;">
                &copy; {{ date('Y') }} NusantaraGreen. All rights reserved. | Portal Ekowisata Indonesia
            </p>
            <p style="margin: 10px 0 0 0; font-size: 12px; opacity: 0.7;">
                Jelajahi keindahan alam Indonesia dengan bertanggung jawab
            </p>
        </div>
    </footer>
</body>
</html>
