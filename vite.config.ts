import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';
import { exec } from 'child_process';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'node:path';
import { defineConfig } from 'vite';

const ziggyWatcher = () => {
    return {
        name: 'ziggy-watcher',
        buildStart() {
            exec('php artisan ziggy:generate', (err, stdout, stderr) => {
                if (err) console.error(stderr);
                else console.log(stdout);
            });
        },
        handleHotUpdate({ file }: { file: string }) {
            if (file.includes('/routes/')) {
                exec('php artisan ziggy:generate', (err, stdout, stderr) => {
                    if (err) console.error(stderr);
                    else console.log(stdout);
                });
            }
        },
    };
};

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.tsx'],
            ssr: 'resources/js/ssr.tsx',
            refresh: true,
        }),
        react(),
        tailwindcss(),
        ziggyWatcher(),
    ],
    esbuild: {
        jsx: 'automatic',
    },
    resolve: {
        alias: {
            'ziggy-js': resolve(__dirname, 'vendor/tightenco/ziggy'),
            '@': resolve(__dirname, 'resources/js'),
        },
    },
});
