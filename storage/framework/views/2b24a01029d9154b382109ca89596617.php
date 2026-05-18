<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>NusantaraGreen - <?php echo $__env->yieldContent('title', 'Ekowisata Indonesia'); ?></title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo.png')); ?>">
    
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Outfit:400,600,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
    
<style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        /* 1. MEMBUAT BODY SEBAGAI FLEXBOX CONTAINER */
        html, body {
            height: 100%;
        }
        body { 
            font-family: 'Outfit', sans-serif; 
            padding-top: 80px;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        
        /* 2. MAIN AKAN MENGISI SEMUA SISA RUANG YANG KOSONG */
        main {
            margin: 0;
            padding: 0;
            flex: 1 0 auto; /* Ini kunci agar footer terdorong ke bawah */
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
        
        /* KIRI: Logo */
        #brand-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            flex: 1;
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

        /* TENGAH: Menu Navigasi (Home - Tentang) */
        #main-nav-container {
            display: flex;
            justify-content: center;
            flex: 2;
        }
        
        #main-menu {
            display: flex;
            list-style: none;
            gap: 10px;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        
        .menu-link {
            padding: 10px 22px;
            border-radius: 25px;
            background: rgba(255,255,255,0.15);
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: 1px solid rgba(255,255,255,0.3);
            white-space: nowrap;
        }
        
        .menu-link:hover, .menu-link.active {
            background: white;
            color: #198754;
        }

        /* KANAN: Tombol Auth */
        #auth-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: flex-end;
            flex: 1;
        }
        
        .btn-dashboard, .btn-logout {
            padding: 10px 24px;
            border-radius: 25px;
            background: white;
            color: #198754;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s;
            white-space: nowrap;
            display: flex;
            align-items: center;
            border: none;
        }
        
        .btn-dashboard:hover, .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            color: #146c43;
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

        /* Aesthetic Pagination */
        .pagination { gap: 8px; margin-top: 20px; }
        .page-item .page-link {
            border: none;
            border-radius: 12px !important;
            padding: 8px 16px;
            color: #198754;
            font-weight: 600;
            background: white;
        }
        .page-item.active .page-link {
            background: linear-gradient(135deg, #198754 0%, #146c43 100%);
            color: white;
        }

        /* 3. FOOTER TETAP MENJAGA UKURANNYA */
        footer {
            flex-shrink: 0;
        }
    </style>
</head>
<body>
    <header id="main-header">
        <div id="header-content">
            <a href="<?php echo e(url('/')); ?>" id="brand-logo">
                <img src="<?php echo e(asset('img/logo.png')); ?>" alt="Logo">
                <div id="brand-text">
                    <span id="brand-name">NusantaraGreen</span>
                    <span id="brand-rating"><i class="bi bi-star-fill"></i> 4.9</span>
                </div>
            </a>
            
            <div id="main-nav-container">
                <nav>
                    <ul id="main-menu">
                        <li><a href="<?php echo e(route('home.index')); ?>" class="menu-link <?php echo e(Request::is('/') ? 'active' : ''); ?>">Home</a></li>
                        <li><a href="<?php echo e(route('destinations.index')); ?>" class="menu-link <?php echo e(Request::is('destinations*') ? 'active' : ''); ?>">Wisata</a></li>
                        <li><a href="<?php echo e(route('education')); ?>" class="menu-link <?php echo e(Request::is('education') ? 'active' : ''); ?>">Paket Edukasi</a></li>
                        <li><a href="<?php echo e(route('invoice.check')); ?>" class="menu-link <?php echo e(Request::is('invoice*') ? 'active' : ''); ?>">Cek Invoice</a></li>
                        <li><a href="<?php echo e(route('about')); ?>" class="menu-link <?php echo e(Request::is('about') ? 'active' : ''); ?>">Tentang</a></li>
                    </ul>
                </nav>
            </div>
            
            <div id="auth-buttons">
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn-login">Login</a>
                    <a href="<?php echo e(route('register')); ?>" class="btn-dashboard">Register</a>
                <?php else: ?>
                    <?php if(Auth::user()->role == 'admin'): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn-login" style="background: rgba(255,255,255,0.2);">
                        <i class="bi bi-speedometer2 me-1"></i>Admin
                    </a>
                    <?php endif; ?>
                    
                    <a href="<?php echo e(route('user.dashboard')); ?>" class="btn-dashboard">
                        <i class="bi bi-grid me-1"></i>Dashboard
                    </a>
                    
                    <a href="<?php echo e(route('logout')); ?>" class="btn-logout" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?></form>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    
    <footer style="background: #198754; color: white; padding: 30px 0;">
        <div style="max-width: 1400px; margin: 0 auto; padding: 0 30px; text-align: center;">
            <p style="margin: 0; font-size: 14px; opacity: 0.9;">
                &copy; <?php echo e(date('Y')); ?> NusantaraGreen. All rights reserved. | Portal Ekowisata Indonesia
            </p>
        </div>
    </footer>
</body>
</html><?php /**PATH D:\Nusantara_id\resources\views/layouts/app.blade.php ENDPATH**/ ?>