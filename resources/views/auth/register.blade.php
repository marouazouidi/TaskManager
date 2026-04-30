<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - {{ config('app.name', 'TaskFlow') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #e8b4d8 0%, #d4a0c8 20%, #c9a0d8 40%, #bfa0e0 60%, #c8a8e8 80%, #d0b0e8 100%);
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .top-bar { display: flex; justify-content: space-between; align-items: center; padding: 20px 32px; width: 100%; }
        .logo { font-size: 1.25rem; font-weight: 600; color: rgba(90, 50, 120, 0.55); letter-spacing: 0.5px; }
        .help-icon { width: 28px; height: 28px; border-radius: 50%; border: 2px solid rgba(90, 50, 120, 0.3); display: flex; align-items: center; justify-content: center; color: rgba(90, 50, 120, 0.4); font-size: 0.85rem; font-weight: 500; cursor: pointer; transition: all 0.3s ease; text-decoration: none; }
        .help-icon:hover { border-color: rgba(90, 50, 120, 0.6); color: rgba(90, 50, 120, 0.7); transform: scale(1.05); }

        .login-wrapper { flex: 1; display: flex; align-items: center; justify-content: center; padding: 0 20px 60px; }

        .login-card {
            width: 100%; max-width: 420px;
            background: rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px; padding: 44px 40px 36px;
            box-shadow: 0 8px 32px rgba(150, 100, 180, 0.15), 0 2px 8px rgba(150, 100, 180, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.4);
            animation: cardFadeIn 0.6s ease-out;
        }
        @keyframes cardFadeIn { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }

        .card-title { text-align: center; margin-bottom: 28px; }
        .card-title h1 { font-size: 1.75rem; font-weight: 700; color: #2d1b3e; margin-bottom: 6px; letter-spacing: -0.3px; }
        .card-title p { font-size: 0.9rem; color: rgba(60, 40, 80, 0.55); font-weight: 400; }

        .form-group { margin-bottom: 16px; }
        .label-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; }
        .form-label { font-size: 0.85rem; font-weight: 500; color: #3a2550; }

        .form-input {
            width: 100%; padding: 13px 20px;
            background: rgba(200, 180, 220, 0.22);
            border: 1px solid rgba(200, 180, 220, 0.25);
            border-radius: 50px;
            font-family: 'Outfit', sans-serif; font-size: 0.9rem; color: #3a2550;
            outline: none; transition: all 0.3s ease;
        }
        .form-input::placeholder { color: rgba(100, 70, 140, 0.4); font-weight: 300; }
        .form-input:focus { border-color: rgba(160, 120, 200, 0.5); background: rgba(200, 180, 220, 0.32); box-shadow: 0 0 0 3px rgba(160, 120, 200, 0.12); }

        .input-error-msg { font-size: 0.78rem; color: #c0392b; margin-top: 6px; padding-left: 20px; }

        .login-btn {
            width: 100%; padding: 14px; border: none; border-radius: 50px;
            background: linear-gradient(135deg, #e8a0c0 0%, #d0a0d8 50%, #b8a0e0 100%);
            color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.95rem; font-weight: 600;
            letter-spacing: 0.5px; cursor: pointer; transition: all 0.3s ease;
            margin-top: 8px; box-shadow: 0 4px 16px rgba(200, 140, 200, 0.3);
        }
        .login-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 24px rgba(200, 140, 200, 0.45); }
        .login-btn:active { transform: translateY(0); }

        .divider { display: flex; align-items: center; margin: 24px 0 20px; gap: 16px; }
        .divider-line { flex: 1; height: 1px; background: rgba(160, 130, 190, 0.3); }
        .divider-text { font-size: 0.78rem; color: rgba(80, 60, 110, 0.45); font-weight: 500; letter-spacing: 1.5px; }

        .signup-row { text-align: center; font-size: 0.85rem; color: rgba(60, 40, 80, 0.55); }
        .signup-row a { color: #6a3d9a; text-decoration: none; font-weight: 600; transition: color 0.2s ease; }
        .signup-row a:hover { color: #4a1d7a; }

        @media (max-width: 480px) {
            .login-card { padding: 32px 24px 28px; border-radius: 20px; }
            .card-title h1 { font-size: 1.5rem; }
            .top-bar { padding: 16px 20px; }
        }
    </style>
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="logo">Task Manager</div>
        <a href="#" class="help-icon" title="Help">?</a>
    </div>

    <!-- Register Card -->
    <div class="login-wrapper">
        <div class="login-card">

            <!-- Title -->
            <div class="card-title">
                <h1>Create Account</h1>
                <p>Join Task Manager and get organized</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <div class="label-row">
                        <label class="form-label" for="name">Name</label>
                    </div>
                    <input id="name" class="form-input" type="text" name="name" value="{{ old('name') }}" placeholder="Your full name" required autofocus autocomplete="name">
                    @error('name')
                        <div class="input-error-msg">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <div class="label-row">
                        <label class="form-label" for="email">Email</label>
                    </div>
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" placeholder="hello@taskflow.com" required autocomplete="username">
                    @error('email')
                        <div class="input-error-msg">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <div class="label-row">
                        <label class="form-label" for="password">Password</label>
                    </div>
                    <input id="password" class="form-input" type="password" name="password" placeholder="••••••••" required autocomplete="new-password">
                    @error('password')
                        <div class="input-error-msg">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <div class="label-row">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                    </div>
                    <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password">
                    @error('password_confirmation')
                        <div class="input-error-msg">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Register Button -->
                <button type="submit" class="login-btn">Register</button>
            </form>

            <!-- Divider -->
            <div class="divider">
                <div class="divider-line"></div>
                <span class="divider-text">OR</span>
                <div class="divider-line"></div>
            </div>

            <!-- Login Link -->
            <div class="signup-row">
                Already have an account? <a href="{{ route('login') }}">Sign In</a>
            </div>

        </div>
    </div>

</body>
</html>
