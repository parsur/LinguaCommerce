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

mix.js('resources/assets/js/app.js', 'public/js')
    // DataTable Persian Language
    .js('resources/assets/js/persian.json', 'public/js/persian.json')
    // App And Authentication
    .postCss('resources/assets/css/app.css', 'public/css')
    // App Css
    .postCss('resources/assets/css/auth.css', 'public/css/auth.css')
    // App Sass
    .sass('resources/assets/sass/app.scss','public/css');

// Images
mix.copy('resources/assets/images', 'public/images');
// Fonts
mix.copy('resources/assets/fonts', 'public/fonts');
// Request Handler
mix.copy('resources/assets/js/requestHandler.js', 'public/js/requestHandler.js')