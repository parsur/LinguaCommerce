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
    .copy('resources/assets/js/persian.json', 'public/js/persian.json')
    // Tinymce initialization
    .copy('resources/assets/js/tinymceInit.js', 'public/js/tinymceInit.js')
    // Ajax Request Handler
    .copy('resources/assets/js/requestHandler.js', 'public/js/requestHandler.js')
    // Tinymce
    .copy('resources/assets/js/tinymce.js', 'public/js/tinymce.js')
    // Tinymce
    .copy('resources/assets/js/imagePreview.js', 'public/js/imagePreview.js')
    // Fonts
    .copy('resources/assets/fonts', 'public/fonts')
    // Images
    .copy('resources/assets/images', 'public/images')
    // App And Authentication
    .css('resources/assets/css/app.css', 'public/css')
    // App Css
    .css('resources/assets/css/auth.css', 'public/css/auth.css')
    // App Sass
    .sass('resources/assets/sass/app.scss','public/css');

mix.sourceMaps();

