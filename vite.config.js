import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
    build: {
        // Optimize build output
        rollupOptions: {
            output: {
                manualChunks: {
                    'vendor': ['axios'],
                    'utils': ['./resources/js/utils/cart.js', './resources/js/utils/notifications.js', './resources/js/utils/lazy-loading.js'],
                },
            },
        },
        // Optimize chunk size
        chunkSizeWarningLimit: 1000,
    },
});
