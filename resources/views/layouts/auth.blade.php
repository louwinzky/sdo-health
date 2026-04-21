<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Login' }} - SDO Health</title>

<<<<<<< Updated upstream
    @include('partials.head')
    @livewireStyles
    @fluxAppearance
</head>
<body class="font-sans antialiased bg-gradient-to-br from-blue-50 to-blue-100 dark:from-zinc-950 dark:to-zinc-900">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <!-- Logo and Dark Mode Toggle -->
            <div class="text-center mb-8">
                <div class="flex justify-end items-center mb-4">
                    <button 
                        x-data="{ dark: localStorage.getItem('appearance') === 'dark' || localStorage.getItem('theme') === 'dark' }"
                        x-init="document.documentElement.classList.toggle('dark', dark); if (dark) { localStorage.setItem('appearance', 'dark'); localStorage.setItem('theme', 'dark'); } else { localStorage.setItem('appearance', 'light'); localStorage.setItem('theme', 'light'); }"
                        @click="dark = !dark; localStorage.setItem('appearance', dark ? 'dark' : 'light'); localStorage.setItem('theme', dark ? 'dark' : 'light'); document.documentElement.classList.toggle('dark', dark)"
                        class="p-3 rounded-lg bg-zinc-200 dark:bg-zinc-800 hover:bg-zinc-300 dark:hover:bg-zinc-700 transition-colors cursor-pointer z-10"
                        aria-label="Toggle dark mode"
                    >
                        <svg x-show="dark" class="w-6 h-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg x-show="!dark" class="w-6 h-6 text-zinc-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>
                </div>
                <h1 class="text-4xl font-bold text-zinc-900 dark:text-white">SDO Health</h1>
                <p class="text-zinc-600 dark:text-zinc-400 mt-2">Legazpi Health System</p>
=======
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
                    <img src="/images/sdo-logo.png" alt="SDO Logo" class="h-24 mx-auto">
                    <div class="flex-1 flex justify-end">
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-slate-800">SDO Health</h1>
                <p class="text-slate-600 mt-1 font-medium">Legazpi City Health System</p>
>>>>>>> Stashed changes
            </div>

            <!-- Auth Card -->
            <div class="card">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="text-center mt-6 text-sm text-zinc-600 dark:text-zinc-400">
                <p>&copy; 2026 Legazpi District Health System. All rights reserved.</p>
            </div>
        </div>
    </div>

    @livewireScripts
    @fluxScripts
</body>
</html>
