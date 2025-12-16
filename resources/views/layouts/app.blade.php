<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#0f172a">
    <title>{{ config('app.name', 'Video Vault') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://unpkg.com/tailwindcss@^3/dist/tailwind.min.css" rel="stylesheet">
    @endif
</head>
<body class="min-h-screen bg-gradient-to-b from-slate-50 via-white to-white text-slate-900 antialiased">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <header class="py-6 flex items-center justify-between">
            <a href="{{ route('videos.index') }}" class="flex items-center gap-3">
                <div class="h-10 w-10 bg-gradient-to-br from-red-500 to-yellow-400 rounded-lg flex items-center justify-center text-white font-bold shadow-lg">VV</div>
                <div>
                    <span class="text-xl font-semibold">Video Vault</span>
                    <div class="text-xs text-slate-500">Discover & share amazing videos</div>
                </div>
            </a>

            <nav class="flex items-center gap-4">
                <a href="{{ route('videos.index') }}" class="text-sm text-slate-700 hover:text-slate-900">Home</a>
                <a href="{{ route('videos.trending') }}" class="text-sm text-slate-700 hover:text-slate-900">Trending</a>
                <a href="{{ route('videos.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 text-white rounded-md text-sm hover:opacity-95">Upload</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-2 text-sm">Register</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </header>

        <main class="py-6">
            @yield('content')
        </main>

        <footer class="py-8 text-center text-sm text-slate-500">
            &copy; {{ date('Y') }} Video Vault — Made with care.
        </footer>
    </div>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/js/app.js'])
    @endif
</body>
</html>
