<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Sandi - NusantaraGreen</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=Outfit:300,400,600,700" rel="stylesheet">
    <style>
        :root {
            --primary: #198754;
            --primary-light: #20c997;
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
            padding: 45px 40px;
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
            margin-bottom: 30px;
        }

        .logo-box {
            width: 60px;
            height: 60px;
            background: #fff;
            padding: 8px;
            border-radius: 18px;
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
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 20px;
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
            border-radius: 12px !important;
            padding: 12px 20px 12px 48px !important;
            color: #333 !important;
            font-size: 0.95rem !important;
        }

        .btn-submit {
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            border: none;
            border-radius: 12px;
            padding: 14px;
            color: #fff;
            font-weight: 700;
            width: 100%;
            transition: 0.3s;
            box-shadow: 0 10px 30px rgba(25, 135, 84, 0.4);
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(25, 135, 84, 0.6);
            color: #fff;
        }

        .error-alert {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.4);
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 20px;
            color: #ffb3b9;
            font-size: 0.85rem;
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
                <h2>Atur Ulang Sandi</h2>
                <p class="subtitle">Silakan masukkan kata sandi baru Anda</p>
            </div>

            @if ($errors->any())
                <div class="error-alert">
                    <ul class="mb-0 list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div class="input-wrapper">
                    <i class="bi bi-envelope-fill"></i>
                    <input type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" placeholder="Email Address" required readonly>
                </div>

                <div class="input-wrapper">
                    <i class="bi bi-shield-lock-fill"></i>
                    <input type="password" class="form-control" name="password" placeholder="Sandi Baru" required autofocus>
                </div>

                <div class="input-wrapper">
                    <i class="bi bi-shield-check"></i>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Sandi Baru" required>
                </div>

                <button type="submit" class="btn-submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</body>
</html>
