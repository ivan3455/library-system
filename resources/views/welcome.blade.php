<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library System</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        .container {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 90%;
        }
        h1 { margin-bottom: 0.5rem; font-size: 1.6rem; color: #111; }
        p { color: #666; margin-bottom: 2rem; font-size: 0.95rem; line-height: 1.4; }
        .nav-lang { margin-bottom: 2rem; }
        .nav-lang a {
            text-decoration: none;
            color: #4f46e5;
            font-weight: bold;
            margin: 0 12px;
            font-size: 0.9rem;
            padding-bottom: 2px;
        }
        .nav-lang a.active { border-bottom: 2px solid #4f46e5; }
        .buttons { display: flex; flex-direction: column; gap: 12px; }
        .btn {
            display: block;
            padding: 14px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.2s;
            font-size: 1rem;
        }
        .btn-primary { background-color: #111827; color: white; }
        .btn-primary:hover { background-color: #1f2937; }
        .btn-outline { border: 1px solid #d1d5db; color: #374151; }
        .btn-outline:hover { background-color: #f9fafb; }
        .footer { margin-top: 2.5rem; font-size: 0.75rem; color: #9ca3af; letter-spacing: 0.05em; }
    </style>
</head>
<body>

    <div class="container">
        <div class="nav-lang">
            <a href="{{ route('lang.switch', 'uk') }}" class="{{ app()->getLocale() == 'uk' ? 'active' : '' }}">UA</a>
            <span style="color: #eee">|</span>
            <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
        </div>

        <h1>{{ __('messages.welcome') }}</h1>
        <p>{{ __('messages.description') }}</p>

        <div class="buttons">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">{{ __('messages.login') }}</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline">{{ __('messages.register') }}</a>
                    @endif
                @endauth
            @endif
        </div>

        <div class="footer">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }}
        </div>
    </div>

</body>
</html>
