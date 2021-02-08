const mix = require('laravel-mix');

mix.setPublicPath('public');
mix.setResourceRoot('../');

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
    // DataTable Persian Language
    .js('resources/js/persian.json', 'publlic/js/persian.json')
    // Ajax Requests
    .js('resources/js/requestHandler.js', 'publlic/js/requestHandler.js')
    // App And Authentication
    .postCss('resources/css/app.css', 'public/css')
    // App Css
    .postCss('resources/css/auth.css', 'public/css/auth.css')
    // App Sass
    .sass('resources/sass/app.scss','public/css');

// Images
mix.copy('resources/images', 'public/images');
// Fonts
mix.copy('resources/fonts', 'public/fonts');