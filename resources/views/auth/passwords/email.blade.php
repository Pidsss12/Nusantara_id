<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Sandi - NusantaraGreen</title>
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

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            font-family: 'Outfit', sans-serif;
            overflow: hidden;
        }

        .main-wrapper {
            height: 100vh;
            width: 100vw;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('{{ asset('img/tourism-bg.png') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 40px;
            padding: 50px 40px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.6);
            z-index: 10;
            animation: fadeIn 1.2s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo-box {
            width: 70px;
            height: 70px;
            background: #fff;
            padding: 10px;
            border-radius: 20px;
            margin: 0 auto 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(-3deg);
        }
        
        .logo-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        h2 {
            color: #fff;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 25px;
        }

        .input-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #198754;
            font-size: 1.1rem;
            z-index: 10;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.9) !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            border-radius: 15px !important;
            padding: 14px 20px 14px 48px !important;
            color: #333 !important;
            font-size: 1rem !important;
        }

        .btn-submit {
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            border: none;
            border-radius: 15px;
            padding: 16px;
            color: #fff;
            font-weight: 700;
            width: 100%;
            transition: 0.3s;
            box-shadow: 0 10px 30px rgba(25, 135, 84, 0.4);
            margin-bottom: 20px;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(25, 135, 84, 0.6);
            color: #fff;
        }

        .footer-text {
            text-align: center;
            color: #fff;
            font-size: 0.9rem;
        }

        .footer-text a {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,0.3);
        }

        .footer-text a:hover {
            color: #ffc107;
            border-bottom-color: #ffc107;
        }

        .status-alert {
            background: rgba(25, 135, 84, 0.2);
            border: 1px solid rgba(25, 135, 84, 0.4);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 25px;
            color: #d1e7dd;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .error-alert {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.4);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 25px;
            color: #ffb3b9;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <div class="glass-card">
            <div class="brand-header">
                <div class="logo-box">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo">
                </div>
                <h2>Lupa Sandi?</h2>
                <p class="subtitle">Kami akan kirimkan tautan reset ke email Anda</p>
            </div>

            @if (session('status'))
                <div class="status-alert">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error-alert">
                    <ul class="mb-0 list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                
                <div class="input-wrapper">
                    <i class="bi bi-envelope-fill"></i>
                    <input type="email" class="form-control" name="email" placeholder="Alamat Email Terdaftar" 
                           value="{{ old('email') }}" required autofocus>
                </div>

                <button type="submit" class="btn-submit">Kirim Tautan Reset</button>
            </form>

            <div class="footer-text">
                Ingat sandi Anda? <a href="{{ route('login') }}">Kembali Log In</a>
            </div>
        </div>
    </div>
</body>
</html>
