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
</head>
</rewritten_file> 