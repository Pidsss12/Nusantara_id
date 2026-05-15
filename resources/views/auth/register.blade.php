<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - NusantaraGreen</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=Outfit:300,400,600,700" rel="stylesheet">
    <style>
        :root {
            --primary: #198754;
            --primary-light: #20c997;
            --primary-glow: rgba(32, 201, 151, 0.4);
        }

        /* Menghilangkan Scrollbar Secara Global */
        ::-webkit-scrollbar {
            display: none;
        }

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            font-family: 'Outfit', sans-serif;
            overflow: hidden; /* Mencegah scroll di body */
            -ms-overflow-style: none;  
            scrollbar-width: none;  
        }

        .main-wrapper {
            height: 100vh;
            width: 100vw;
            display: flex;
            background-color: #f8faf9;
            overflow: hidden;
        }

        /* Sisi Kiri: Form Registrasi */
        .register-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: white;
            z-index: 2;
            overflow: hidden; /* Scroll dihapus sesuai permintaan */
        }

        /* Sisi Kanan: Visual Hijau */
        .visual-side {
            flex: 1.2;
            position: relative;
            background: linear-gradient(135deg, rgba(25, 135, 84, 0.85), rgba(10, 31, 20, 0.95)), url('{{ asset('img/tourism-bg.png') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .visual-side::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0);
            background-size: 32px 32px;
        }

        .glass-card {
            width: 100%;
            max-width: 440px;
            position: relative;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .brand-header {
            text-align: left;
            margin-bottom: 30px;
        }

        .logo-box {
            width: 60px;
            height: 60px;
            background: #f0fdf4;
            padding: 10px;
            border-radius: 18px;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(25, 135, 84, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        h2 {
            color: #1a1a1a;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 15px; /* Sedikit dirapatkan agar pas di layar tanpa scroll */
        }

        .input-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 1.1rem;
            z-index: 10;
        }

        .form-control {
            background: #f8faf9 !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 12px !important;
            padding: 12px 20px 12px 48px !important;
            color: #333 !important;
            font-size: 0.95rem !important;
            transition: all 0.3s ease !important;
        }

        .form-control:focus {
            background: #fff !important;
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 4px var(--primary-glow) !important;
        }

        .btn-submit {
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            border: none;
            border-radius: 12px;
            padding: 14px;
            color: #fff;
            font-weight: 700;
            width: 100%;
            box-shadow: 0 8px 25px rgba(25, 135, 84, 0.25);
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(25, 135, 84, 0.35);
        }

        .footer-text {
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .footer-text a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
        }

        .error-alert {
            background: #fff5f5;
            border: 1px solid #feb2b2;
            border-radius: 12px;
            padding: 10px;
            margin-bottom: 15px;
            color: #c53030;
            font-size: 0.8rem;
        }

        .visual-content {
            position: relative;
            z-index: 5;
            color: white;
            text-align: center;
            padding: 40px;
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <div class="register-side">
            <div class="glass-card">
                <div class="brand-header">
                    <div class="logo-box">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo">
                    </div>
                    <h2>Daftar Akun</h2>
                    <p class="subtitle">Bergabunglah menjaga Nusantara</p>
                </div>

                @if ($errors->any())
                    <div class="error-alert">
                        <ul class="mb-0 list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li><i class="bi bi-exclamation-circle me-1"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-wrapper">
                        <i class="bi bi-person-fill"></i>
                        <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
                    </div>
                    
                    <div class="input-wrapper">
                        <i class="bi bi-envelope-at-fill"></i>
                        <input type="email" class="form-control" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
                    </div>
                    
                    <div class="input-wrapper">
                        <i class="bi bi-shield-lock-fill"></i>
                        <input type="password" class="form-control" name="password" placeholder="Kata Sandi" required>
                    </div>
                    
                    <div class="input-wrapper">
                        <i class="bi bi-shield-check"></i>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Sandi" required>
                    </div>
                    
                    <button type="submit" class="btn-submit">Daftar Sekarang</button>
                </form>
                
                <div class="footer-text">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk Disini</a>
                </div>
            </div>
        </div>

        <div class="visual-side">
            <div class="visual-content">
                <h1 class="display-5 fw-bold mb-3">Mulai Perjalananmu</h1>
                <p class="lead opacity-75">Jadilah bagian dari komunitas ekowisata terbesar di Indonesia.</p>
            </div>
        </div>
    </div>
</body>
</html>