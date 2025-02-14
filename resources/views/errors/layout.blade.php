<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
        <div class="text-center p-8 bg-white rounded-lg shadow-md max-w-md w-full mx-4">
            <h1 class="text-6xl font-bold text-gray-800 mb-4">@yield('code')</h1>
            <p class="text-xl text-gray-600 mb-6">@yield('message')</p>
            <div class="space-y-4">
                <a href="{{ url('/') }}" class="inline-block px-6 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                    Kembali ke Beranda
                </a>
                @if(auth()->check())
                    <a href="{{ url('/dashboard') }}" class="block text-sm text-indigo-600 hover:text-indigo-500">
                        Ke Dashboard
                    </a>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
