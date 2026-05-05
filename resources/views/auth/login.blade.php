<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NusantaraGreen</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=Outfit:300,400,600,700" rel="stylesheet">
    <style>
        :root {
            --primary: #198754;
            --primary-light: #20c997;
            --primary-glow: rgba(32, 201, 151, 0.4);
            --bg-dark: #0a1f14;
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
            position: relative;
            z-index: 10;
            animation: fadeIn 1.2s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-box {
            width: 80px;
            height: 80px;
            background: #fff;
            padding: 12px;
            border-radius: 24px;
            margin: 0 auto 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(-3deg);
            transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .logo-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        h2 {
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
            font-weight: 400;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 25px;
        }

        .input-wrapper i.prefix-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #198754; /* Dark green for high contrast */
            font-size: 1.2rem;
            z-index: 10;
            pointer-events: none;
            opacity: 1 !important;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.9) !important; /* Semi-solid for better contrast */
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            border-radius: 15px !important;
            padding: 14px 20px 14px 50px !important;
            color: #333 !important; /* Dark text for readability */
            font-size: 1rem !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05) !important;
        }

        .form-control::placeholder {
            color: #999 !important;
        }

        .form-control:focus {
            background: #fff !important;
            border-color: var(--primary-light) !important;
            box-shadow: 0 0 20px var(--primary-glow) !important;
        }

        .pass-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #198754; /* Match theme */
            cursor: pointer;
            z-index: 10;
            font-size: 1.2rem;
            background: none;
            border: none;
            padding: 5px;
            display: flex;
            align-items: center;
        }

        .form-utils {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            font-size: 0.95rem;
            color: #fff;
            padding: 0 5px;
        }

        .check-container {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .form-check-input {
            width: 1.1em;
            height: 1.1em;
            margin: 0;
            cursor: pointer;
            border: 2px solid white;
        }

        .forgot-pass {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            transition: 0.3s;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            border-bottom: 2px solid rgba(255,255,255,0.3);
        }

        .forgot-pass:hover {
            color: #ffc107;
            border-bottom-color: #ffc107;
        }

        .btn-submit {
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            border: none;
            border-radius: 18px;
            padding: 16px;
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.4s;
            box-shadow: 0 10px 30px rgba(25, 135, 84, 0.4);
            margin-bottom: 25px;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(25, 135, 84, 0.6);
            color: #fff;
        }

        .footer-text {
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
        }

        .footer-text a {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            margin-left: 5px;
            transition: 0.3s;
        }

        .footer-text a:hover {
            color: var(--primary-light);
        }

        .custom-alert {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.4);
            border-radius: 18px;
            padding: 15px 20px;
            margin-bottom: 25px;
            color: #ffb3b9;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 12px;
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
                <h2>Selamat Datang</h2>
                <p class="subtitle">Eksplorasi Alam Nusantara</p>
            </div>

            @if ($errors->any())
                <div class="custom-alert">
                    <i class="bi bi-exclamation-circle-fill fs-5"></i>
                    <ul class="mb-0 list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="input-wrapper">
                    <i class="bi bi-person-circle prefix-icon"></i>
                    <input type="email" class="form-control" name="email" placeholder="Alamat Email" 
                           value="{{ old('email') }}" required autofocus>
                </div>
                
                <div class="input-wrapper">
                    <i class="bi bi-shield-lock prefix-icon"></i>
                    <input type="password" id="password" class="form-control" name="password" placeholder="Kata Sandi" required>
                    <button type="button" class="pass-toggle" onclick="togglePassword()">
                        <i class="bi bi-eye-fill" id="eyeIcon"></i>
                    </button>
                </div>

                <div class="form-utils">
                    <label class="check-container">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        Ingat Saya
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-pass">Lupa Sandi?</a>
                </div>

                <button type="submit" class="btn-submit">Masuk Sekarang</button>
            </form>

            <div class="footer-text">
                Belum punya akun? <a href="{{ route('register') }}">Daftar Disini</a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const pass = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            
            if (pass.type === 'password') {
                pass.type = 'text';
                icon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
            } else {
                pass.type = 'password';
                icon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
            }
        }
    </script>
</body>
</html>
