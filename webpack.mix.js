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

mix.js('resources/js/main.js', 'public/js')
    .js('resources/js/vendor.js', 'public/js')
    .js('resources/js/admin_vendor.js', 'public/js')
    .js('resources/js/pages/calculator.js', 'public/js/pages/calculator.js')
    .js('resources/js/helpers/heartbeat.js', 'public/js/helpers/')
    .js('resources/js/pages/images/list.js', 'public/js/pages/images/list.js')
    .js('resources/js/pages/home/edit.js', 'public/js/pages/home/edit.js')
    .js('resources/js/pages/home/home.js', 'public/js/pages/home/home.js')
    .js('resources/js/pages/blog/form.js', 'public/js/pages/blog/form.js')
    .js('resources/js/pages/blog/list.js', 'public/js/pages/blog/list.js')
    .js('resources/js/pages/event/form.js', 'public/js/pages/event/form.js')
    .sass('resources/sass/main.scss', 'public/css')
    .sass('resources/sass/vendor.scss', 'public/css')
    .version();
