<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Stembayo</title>
    
    <!-- CSS -->
    @vite('resources/css/app.css')
    @include('assets/asset')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @yield('styles')
</head>
<body>
@include('layouts.navbar', ['user' => $user])
@include('layouts.sidebar', ['user' => $user])
    
    <div class="content">
        @yield('content')
    </div>
    

    @include('layouts.footer')

    <!-- Scripts -->
    @push('scripts')
        <script src="{{ asset('js/notifications.js') }}"></script>
    @endpush
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
