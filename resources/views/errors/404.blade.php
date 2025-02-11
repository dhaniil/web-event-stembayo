<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>404 - Halaman Tidak Ditemukan</title>
        <!-- Fonts and Styles -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            /* ...existing styles... */
        </style>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <!-- Sidebar and Header -->
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <!-- ...existing header code... -->
                    </header>
                    <main class="mt-6 text-center">
                        <div class="mb-8">
                            <svg class="mx-auto w-32 h-32 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                <path stroke-width="2" d="M12 17h.01"/>
                                <path stroke-width="2" d="M12 8.5v5"/>
                            </svg>
                        </div>
                        <h1 class="text-6xl font-bold bg-gradient-to-r from-blue-500 to-purple-500 text-transparent bg-clip-text">404</h1>
                        <p class="mt-4 text-xl font-semibold text-gray-700 dark:text-gray-300">Maaf, halaman yang Anda cari tidak dapat ditemukan.</p>
                        <p class="mt-2 text-sm/relaxed text-gray-600 dark:text-gray-400">Silakan periksa URL atau kembali ke <a href="{{ url('/') }}" class="text-blue-500 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">beranda</a>.</p>
                    </main>
                    <!-- Footer -->
                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        <!-- Footer content without Laravel version -->
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
