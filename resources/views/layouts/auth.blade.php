<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Login' }} - SDO Health</title>

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
