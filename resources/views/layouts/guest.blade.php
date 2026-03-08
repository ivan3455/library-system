<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .lang-switch-guest {
                margin-bottom: 1rem;
                font-family: sans-serif;
            }
            .lang-switch-guest a {
                text-decoration: none;
                color: #4f46e5;
                font-weight: bold;
                margin: 0 8px;
                font-size: 0.85rem;
            }
            .lang-switch-guest a.active {
                border-bottom: 2px solid #4f46e5;
                color: #111;
            }
            .lang-divider {
                color: #d1d5db;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

            <div class="lang-switch-guest">
                <a href="{{ route('lang.switch', 'uk') }}" class="{{ app()->getLocale() == 'uk' ? 'active' : '' }}">UA</a>
                <span class="lang-divider">|</span>
                <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
            </div>

            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
