<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Gaming Tournament Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background:
                linear-gradient(
                    rgba(8, 12, 30, 0.88),
                    rgba(8, 12, 30, 0.95)
                ),
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

        /* PASSWORD VISIBILITY */
        .password-wrap {
            position: relative;
        }

        .password-wrap .form-control {
            padding-right: 52px;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #c7d1e8;
            padding: 6px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .password-toggle:hover {
            color: white;
        }

        .password-toggle:focus-visible {
            outline: 2px solid #8b5cf6;
            border-radius: 5px;
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

        <!-- EMAIL -->
        <div class="mb-3">

            <label for="email" class="form-label">
                Email Address
            </label>

            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                placeholder="Enter your email"
                value="{{ old('email') }}"
                autocomplete="email"
                required
                autofocus
            >

        </div>

        <!-- PASSWORD -->
        <div class="mb-3">

            <label for="password" class="form-label">
                Password
            </label>

            <div class="password-wrap">

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                >

                <button
                    type="button"
                    class="password-toggle"
                    id="passwordToggle"
                    aria-label="Show password"
                    aria-pressed="false"
                    title="Show password">

                    <!-- EYE OPEN -->
                    <svg
                        id="eyeOpen"
                        xmlns="http://www.w3.org/2000/svg"
                        width="22"
                        height="22"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round">

                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                        <circle cx="12" cy="12" r="3"/>

                    </svg>

                    <!-- EYE CLOSED -->
                    <svg
                        id="eyeClosed"
                        xmlns="http://www.w3.org/2000/svg"
                        width="22"
                        height="22"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        style="display:none">

                        <path d="M3 3l18 18"/>
                        <path d="M10.6 5.1A10.9 10.9 0 0 1 12 5c6.5 0 10 7 10 7a16.4 16.4 0 0 1-3.1 4.1"/>
                        <path d="M6.3 6.3C3.5 8.3 2 12 2 12s3.5 7 10 7c1.7 0 3.2-.5 4.5-1.2"/>

                    </svg>

                </button>

            </div>

        </div>

        <!-- REMEMBER ME -->
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

        <!-- LOGIN BUTTON -->
        <button type="submit" class="btn login-btn w-100">
            LOGIN
        </button>

    </form>

</div>

<script>
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('passwordToggle');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    passwordToggle.addEventListener('click', function () {

        const showPassword = passwordInput.type === 'password';

        passwordInput.type = showPassword ? 'text' : 'password';

        passwordToggle.setAttribute(
            'aria-pressed',
            String(showPassword)
        );

        passwordToggle.setAttribute(
            'aria-label',
            showPassword ? 'Hide password' : 'Show password'
        );

        passwordToggle.title = showPassword
            ? 'Hide password'
            : 'Show password';

        eyeOpen.style.display = showPassword ? 'none' : '';
        eyeClosed.style.display = showPassword ? '' : 'none';

    });
</script>

</body>
</html>
