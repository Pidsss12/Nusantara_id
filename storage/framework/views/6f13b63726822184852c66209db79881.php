<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NusantaraGreen</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo.png')); ?>">
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
            display: flex;
            background-color: #f8faf9;
        }

        /* Left Side: Login Form */
        .login-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: white;
            z-index: 2;
        }

        /* Right Side: Motif/Image */
        .visual-side {
            flex: 1.2;
            position: relative;
            background: linear-gradient(135deg, rgba(25, 135, 84, 0.8), rgba(10, 31, 20, 0.9)), url('<?php echo e(asset('img/tourism-bg.png')); ?>');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Decorative Motif Overlay */
        .visual-side::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0);
            background-size: 32px 32px;
        }

        .glass-card {
            width: 100%;
            max-width: 420px;
            position: relative;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .brand-header {
            text-align: left;
            margin-bottom: 40px;
        }

        .logo-box {
            width: 70px;
            height: 70px;
            background: #f0fdf4;
            padding: 12px;
            border-radius: 20px;
            margin-bottom: 25px;
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
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: #6c757d;
            font-size: 1rem;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .input-wrapper i.prefix-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 1.2rem;
            z-index: 10;
        }

        .form-control {
            background: #f8faf9 !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 15px !important;
            padding: 14px 20px 14px 50px !important;
            color: #333 !important;
            transition: all 0.3s ease !important;
        }

        .form-control:focus {
            background: #fff !important;
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 4px var(--primary-glow) !important;
        }

        .pass-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            cursor: pointer;
            z-index: 10;
            border: none;
            background: none;
        }

        .form-utils {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            font-size: 0.9rem;
        }

        .forgot-pass {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .btn-submit {
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            border: none;
            border-radius: 15px;
            padding: 16px;
            color: #fff;
            font-weight: 700;
            width: 100%;
            box-shadow: 0 8px 20px rgba(25, 135, 84, 0.2);
            margin-bottom: 25px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(25, 135, 84, 0.3);
        }

        .footer-text {
            text-align: center;
            color: #6c757d;
        }

        .footer-text a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
        }

        .custom-alert {
            background: #fff5f5;
            border: 1px solid #feb2b2;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 20px;
            color: #c53030;
            font-size: 0.9rem;
        }

        /* Text overlay on visual side */
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
        <div class="login-side">
            <div class="glass-card">
                <div class="brand-header">
                    <div class="logo-box">
                        <img src="<?php echo e(asset('img/logo.png')); ?>" alt="Logo">
                    </div>
                    <h2>Selamat Datang</h2>
                    <p class="subtitle">Silakan masuk ke akun NusantaraGreen Anda</p>
                </div>

                <?php if($errors->any()): ?>
                    <div class="custom-alert d-flex align-items-center gap-2">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <ul class="mb-0 list-unstyled">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="input-wrapper">
                        <i class="bi bi-person-circle prefix-icon"></i>
                        <input type="email" class="form-control" name="email" placeholder="Alamat Email" value="<?php echo e(old('email')); ?>" required autofocus>
                    </div>
                    
                    <div class="input-wrapper">
                        <i class="bi bi-shield-lock prefix-icon"></i>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Kata Sandi" required>
                        <button type="button" class="pass-toggle" onclick="togglePassword()">
                            <i class="bi bi-eye-fill" id="eyeIcon"></i>
                        </button>
                    </div>

                    <div class="form-utils">
                        <label class="d-flex align-items-center gap-2" style="cursor: pointer;">
                            <input type="checkbox" class="form-check-input mt-0" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <span>Ingat Saya</span>
                        </label>
                        <a href="<?php echo e(route('password.request')); ?>" class="forgot-pass">Lupa Sandi?</a>
                    </div>

                    <button type="submit" class="btn-submit">Masuk Sekarang</button>
                </form>

                <div class="footer-text">
                    Belum punya akun? <a href="<?php echo e(route('register')); ?>">Daftar Disini</a>
                </div>
            </div>
        </div>

        <div class="visual-side">
            <div class="visual-content">
                <h1 class="display-4 fw-bold mb-3">Lestarikan Alam</h1>
                <p class="lead opacity-75">Bergabunglah dalam menjaga keasrian destinasi ekowisata Indonesia bersama NusantaraGreen.</p>
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
</html><?php /**PATH D:\Nusantara_id\resources\views/auth/login.blade.php ENDPATH**/ ?>