    import { defineConfig } from 'vite';
    import laravel, { refreshPaths } from 'laravel-vite-plugin'
    import tailwindcss from '@tailwindcss/vite'

    export default defineConfig({
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/admin/theme.css'],
                refresh: [
                    ...refreshPaths,
                    'app/Http/Livewire/**', // Custom Livewire components
                    'app/Filament/**', // Filament Resources
                    'app/Providers/**'
                ],
            }),
            tailwindcss(),
        ],
    });
