<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle ?? 'Login' }} - SDO Health</title>

    <!-- CDN Scripts & Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="{{ asset('css/flux.css') }}">
    <style>
        .card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.65);
            box-shadow: 0 35px 90px rgba(15, 23, 42, 0.18);
        }

        .card input,
        .card textarea,
        .card select,
        .card button {
            background-color: #f3f4f6;
            border-color: #d1d5db;
        }

        .card input:focus,
        .card textarea:focus,
        .card select:focus {
            background-color: #e5e7eb;
            border-color: #9ca3af;
            outline: none;
            box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.2);
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen relative bg-slate-50 text-slate-900">
    <!-- Background -->
    <div class="absolute inset-0 -z-10 bg-gradient-to-br from-cyan-400 via-blue-400 to-sky-600"></div>

    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <!-- Logo and Theme Toggle -->
            <div class="text-center mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-1"></div>
                    <img src="https://sdolegazpicity.com/wp-content/uploads/2025/12/cropped-LOGO-sdo-leg-1-1.png" alt="SDO Logo" class="h-24 mx-auto">
                    <div class="flex-1 flex justify-end">
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-slate-800">SDO Health</h1>
                <p class="text-slate-600 mt-1 font-medium">Legazpi City Health System</p>
            </div>

            <!-- Auth Card -->
            <div class="card rounded-2xl shadow-2xl p-8">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="text-center mt-6 text-sm text-blue-100/70">
                <p>&copy; 2026 Legazpi District Health System. All rights reserved.</p>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
