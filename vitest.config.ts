import { defineConfig } from 'vitest/config';

export default defineConfig({
    test: {
        globals: true,
        environment: 'jsdom',
        setupFiles: './vitest.setup.mjs',
        coverage: {
            include: ['resources/js/**/*.{ts,tsx,js,jsx}'],
        },
    },
});
