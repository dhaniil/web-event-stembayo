<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Broadcasting
    |--------------------------------------------------------------------------
    |
    | By uncommenting the Laravel Echo configuration, you may connect Filament
    | to any Pusher-compatible websockets server.
    |
    | This will allow your users to receive real-time notifications.
    |
    */

    /*
    |----------------------------------------------------------------------
    | Panels Configuration
    |----------------------------------------------------------------------
    |
    | Filament menggunakan panel untuk mengelola halaman dan sumber daya.
    | Pastikan untuk menambahkan panel default untuk aplikasi Anda.
    |
    */
    'panels' => [
        'default' => [
            'path' => 'admin',
            'resources' => [],
            'pages' => [
                'register' => [],
            ],
            'widgets' => [],
        ],
    ],
    'brand' => 'Admin Panel Stembayo', 
    'title' => 'Dashboard Admin Stembayo', // Title di tab browser
    'middleware' => [
        'auth',
        'filament', // Middleware bawaan Filament
        'filament-admin', // Middleware untuk mengecek role
    ],

    /*
    |--------------------------------------------------------------------------
    | Protected Emails Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration stores the list of protected email addresses that
    | should not be displayed or editable in the admin panel. These emails
    | are typically for system administrators and developers.
    |
    */
    'protected_emails' => [
        env('PROTECTED_EMAIL_1', 'admin@admin.com'),
        env('PROTECTED_EMAIL_2', ''),
        env('PROTECTED_EMAIL_3', ''),
    ],

    'broadcasting' => [
        // 'echo' => [
        //     'broadcaster' => 'pusher',
        //     'key' => env('VITE_PUSHER_APP_KEY'),
        //     'cluster' => env('VITE_PUSHER_APP_CLUSTER'),
        //     'wsHost' => env('VITE_PUSHER_HOST'),
        //     'wsPort' => env('VITE_PUSHER_PORT'),
        //     'wssPort' => env('VITE_PUSHER_PORT'),
        //     'authEndpoint' => '/broadcasting/auth',
        //     'disableStats' => true,
        //     'encrypted' => true,
        //     'forceTLS' => true,
        // ],
    ],

    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),
    'assets_path' => null,
    'cache_path' => base_path('bootstrap/cache/filament'),
    'livewire_loading_delay' => 'default',
];
