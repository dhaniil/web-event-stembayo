<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stembayo Events</title>
    {{-- ambil dari assets/asset --}}
      @include('assets/asset')
    <link rel="stylesheet" href="{{ asset('css/default/default.css') }}" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @yield('styles')
</head>
<body>
    {{-- Navbar --}}
    @include('layouts.navbar', ['user' => $user])

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

    @push('scripts')
        <script src="{{ asset('js/notifications.js') }}"></script>
    @endpush
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>
</html>
