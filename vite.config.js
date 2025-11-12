import laravel from 'laravel-vite-plugin'
import { defineConfig } from 'vite'

export default defineConfig({
    plugins: [laravel({ input: ['resources/sass/app.scss', 'resources/js/app.js'], refresh: true })],
    css: {
        preprocessorOptions: {
            // Afecta a .sass (sangrado) y a .scss
            sass: {
                quietDeps: true,
                silenceDeprecations: ['import', 'global-builtin', 'color-functions', 'legacy-js-api'],
            },
            scss: {
                quietDeps: true,
                silenceDeprecations: ['import', 'global-builtin', 'color-functions', 'legacy-js-api'],
                // Si te aparece el warning del “legacy JS API”, activa el compilador moderno:
                api: 'modern-compiler'
            }
        }
    }
})
