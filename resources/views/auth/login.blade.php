<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Gaming Tournament Management System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            min-height: 100vh;
            background:
                linear-gradient(rgba(8, 12, 30, 0.88), rgba(8, 12, 30, 0.95)),
                url('https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=2000&q=80')
                center/cover no-repeat;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            background: rgba(20, 25, 50, 0.95);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            box-shadow: 0 25px 70px rgba(0,0,0,0.5);
        }

        .gaming-title {
            font-weight: 800;
            letter-spacing: 1px;
        }

        .login-btn {
            border: none;
            border-radius: 12px;
            padding: 13px;
            font-weight: 700;
            background: linear-gradient(135deg, #6f42c1, #0d6efd);
            color: white;
            transition: 0.2s;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(13,110,253,0.35);
            color: white;
        }

        .form-control {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: white;
            border-radius: 10px;
            padding: 12px;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.1);
            color: white;
            border-color: #6f42c1;
            box-shadow: 0 0 0 0.2rem rgba(111,66,193,0.2);
        }

        .form-control::placeholder {
            color: #aaa;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center p-3">

<div class="login-card p-4 p-md-5 text-white">

    <div class="text-center mb-4">
        <div class="fs-1 mb-2">🎮</div>

        <h2 class="gaming-title">
            GAMING TOURNAMENT
        </h2>

        <p class="text-secondary mb-0">
            Management System
        </p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email Address</label>

            <input
                type="email"
                name="email"
                class="form-control"
                placeholder="Enter your email"
                value="{{ old('email') }}"
                required
                autofocus
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>

            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Enter your password"
                required
            >
        </div>

        <div class="form-check mb-4">
            <input
                class="form-check-input"
                type="checkbox"
                name="remember"
                id="remember"
            >

            <label class="form-check-label" for="remember">
                Remember me
            </label>
        </div>

        <button type="submit" class="btn login-btn w-100">
            LOGIN
        </button>
    </form>

</div>

</body>
</html>