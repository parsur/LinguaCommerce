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
    // React
    .js('resources/assets/js/react', 'public/js/reactJs').react()
    // Tinymce initialization
    .js('resources/assets/js/tinymceInit.js', 'public/js/tinymceInit.js')
    // Tinymce(read only) initialization
    .js('resources/assets/js/tinymceInitReadOnly.js', 'public/js/tinymceInitReadOnly.js')
    // Ajax Request Handler
    .copy('resources/assets/js/requestHandler.js', 'public/js/requestHandler.js')
    // Comment Submission
    .js('resources/assets/js/commentSubmission.js', 'public/js/commentSubmission.js')
    // Image preview
    .js('resources/assets/js/imagePreview.js', 'public/js/imagePreview.js')
    // Image preview
    .js('resources/assets/js/tinymce.min.js', 'public/js/tinymce.min.js')
    // Fonts
    .copy('resources/assets/fonts', 'public/fonts')
    // DataTable Persian Language
    .copy('resources/assets/js/persian.json', 'public/js/persian.json')
    // Particles json
    .copy('resources/assets/js/particles.json', 'public/js/particles.json')
    // App And Authentication
    .css('resources/assets/css/app.css', 'public/css')
    // App Css
    .css('resources/assets/css/auth.css', 'public/css/auth.css')
    // App Css
    .css('resources/assets/css/tinymce.css', 'public/css/tinymce.css')
    // App Sass
    .sass('resources/assets/sass/app.scss','public/css');

    
mix.sourceMaps();




