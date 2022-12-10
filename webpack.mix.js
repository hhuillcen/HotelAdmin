const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/layouts/dashboard.js', 'public/js/layouts')
    .js('resources/js/admin/rooms/index.js', 'public/js/admin/rooms')
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss")
    ])
    .copyDirectory('resources/icons', 'public/icons')
    .copyDirectory('resources/img', 'public/img')
    .version()
