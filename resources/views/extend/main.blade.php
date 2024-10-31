<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stembayo Events</title>
    {{-- ambil dari assets/asset --}}
      @include('assets/asset')
    <link rel="stylesheet" href="{{ asset('css/default/default.css') }}" /> 
    @yield('styles')
</head>
<body>
    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Sidebar --}}
    @include('layouts.sidebar', ['user' => $user])

    {{-- <div class="content">
        @yield('content') 
    </div> --}}

    {{-- Content --}}
    <main>
        @yield('content') 
    </main>

    {{-- Footer --}}
    @include('layouts.footer')
      
</body>
</html>
