import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/filament/admin/theme.css',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        strictPort: true,
        port: 5173,
        cors: true,
        hmr: {
            host: '10.20.12.137',
            protocol: 'ws'
        },
        headers: {
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Methods': 'GET,HEAD,PUT,PATCH,POST,DELETE',
            'Access-Control-Allow-Headers': 'Origin, X-Requested-With, Content-Type, Accept'
        }
    },
});
