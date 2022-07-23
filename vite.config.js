import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/map.css',
                'resources/js/app.js',

                //
                'resources/js/dashboard/index.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
        }
    },
    server: {
        port: 3000,
        host: 'localhost',
        https: {
            key: './bootstrap/server.key',
            cert: './bootstrap/server.pem',
        }
    }
});
