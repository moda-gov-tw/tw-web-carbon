import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
        host: true,
        hmr: {
            host: "localhost"
        },
        watch: {
          usePolling: true,
        },
    },
    plugins: [
        laravel({
            input: ['resources/js/home.js', 'resources/css/app.css'],
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            }
        }),
    ],
    build: {
    rollupOptions: {
        output: {
        entryFileNames: `[hash].js`,
        chunkFileNames: `[hash].js`,
        assetFileNames: `[hash].[ext]`
        }
    }
    },
    ssr: {
        noExternal: [
            'laravel-vite-plugin',
            '@inertiajs/server',
        ],
    },
});
