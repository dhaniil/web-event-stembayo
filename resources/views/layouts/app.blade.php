<!DOCTYPE html>
<html>
<head>
    <!-- ... -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Fallback jika Vite gagal load -->
    <script>
        if (typeof window.__vite_is_modern_browser === 'undefined') {
            document.write('<script type="module" src="{{ asset("build/assets/app.js") }}"><\/script>');
        }
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
</rewritten_file> 