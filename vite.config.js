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
            // Force HTTPS for assets during development if your site uses HTTPS
            https: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        strictPort: true,
        port: 5173,
        cors: true,
        hmr: {
            host: process.env.VITE_HMR_HOST || 'localhost',
            protocol: 'ws'
        },
        headers: {
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Methods': 'GET,HEAD,PUT,PATCH,POST,DELETE',
            'Access-Control-Allow-Headers': 'Origin, X-Requested-With, Content-Type, Accept'
        },
        https: true, // Enable HTTPS for the dev server
    },
    build: {
        manifest: true,
        outDir: 'public/build',
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: [
                        'vue',
                    ]
                }
            }
        }
    }
});
