<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — SwiftLogix</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root { --navy: #0D1B2A; --orange: #F4A025; }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--navy) 0%, #1a2e45 50%, #253d57 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
        }
        .brand {
            text-align: center;
            margin-bottom: 2rem;
        }
        .brand-icon {
            width: 56px; height: 56px;
            background: var(--orange);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 0.75rem;
        }
        .brand-name { font-size: 1.5rem; font-weight: 800; color: var(--navy); }
        .brand-name span { color: var(--orange); }
        .brand-sub { font-size: 0.85rem; color: #6c757d; }
        .form-control {
            border: 1.5px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 0.2rem rgba(244,160,37,0.2);
        }
        .form-label { font-weight: 600; font-size: 0.87rem; color: var(--navy); }
        .btn-login {
            background: var(--orange);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.85rem;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            transition: all 0.2s;
        }
        .btn-login:hover {
            background: #e8901a;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(244,160,37,0.35);
        }
        .alert { border-radius: 10px; border: none; font-size: 0.87rem; }
        .input-icon { position: relative; }
        .input-icon i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 0.9rem;
        }
        .input-icon input { padding-left: 2.5rem; }
        .back-link { text-align: center; margin-top: 1.5rem; }
        .back-link a { color: #6c757d; font-size: 0.85rem; text-decoration: none; }
        .back-link a:hover { color: var(--navy); }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand">
            <div class="brand-icon"><i class="fas fa-shipping-fast"></i></div>
            <div class="brand-name">Swift<span>Logix</span></div>
            <div class="brand-sub">Panel Administrator</div>
        </div>

        @if($errors->any())
        <div class="alert alert-danger mb-4">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="admin@swiftlogix.id" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="••••••••" required>
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label text-muted small" for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt me-2"></i> Masuk ke Admin Panel
            </button>
        </form>

        <div class="back-link">
            <a href="{{ route('home') }}"><i class="fas fa-arrow-left me-1"></i> Kembali ke Website</a>
        </div>
    </div>
</body>
</html>
