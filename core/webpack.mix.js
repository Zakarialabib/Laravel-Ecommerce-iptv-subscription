const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const tailwindcss = require('tailwindcss');


mix.setPublicPath(`../assets/`)
.js('resources/js/app.js', 'admin/js')
.js('resources/js/sales.js', 'admin/js')
.js('resources/js/sales-lock.js', 'admin/js')
.js('resources/js/package-renew.js', 'admin/js')
.js('resources/js/purchases.js', 'admin/js')
.sass('resources/sass/style.scss', 'front/css')
.sass('resources/sass/tailwind.scss', 'admin/css')
.options({
    processCssUrls: false,
    postCss: [ tailwindcss('./tailwind.config.js') ],
});

if (mix.inProduction()) {
    mix.version();
}
