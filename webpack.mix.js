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

mix.js('resources/js/app.js', 'public/js/stock')
    .sass('resources/sass/stock/app.scss', 'public/css/stock');

mix.sass('resources/sass/stock/tabel-data.scss', 'public/css/stock');
mix.sass('resources/sass/stock/mgmt-data.scss', 'public/css/stock');
