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
    // DataTable Persian Language
    .copy('resources/assets/js/persian.json', 'public/js/persian.json')
    // Particles json
    .copy('resources/assets/js/particles.json', 'public/js/particles.json')
    // Tinymce initialization
    .copy('resources/assets/js/tinymceInit.js', 'public/js/tinymceInit.js')
    // Ajax Request Handler
    .copy('resources/assets/js/requestHandler.js', 'public/js/requestHandler.js')
    // Comment Submission
    .copy('resources/assets/js/commentSubmission.js', 'public/js/commentSubmission.js')
    // Image preview
    .copy('resources/assets/js/imagePreview.js', 'public/js/imagePreview.js')
    // Image preview
    .copy('resources/assets/js/tinymce.min.js', 'public/js/tinymce.min.js')
    // CK Editor
    .copy('resources/assets/ckeditor', 'public/ckeditor')
    // Fonts
    .copy('resources/assets/fonts', 'public/fonts')
    // App And Authentication
    .css('resources/assets/css/app.css', 'public/css')
    // App Css
    .css('resources/assets/css/auth.css', 'public/css/auth.css')
    // App Sass
    .sass('resources/assets/sass/app.scss','public/css');

    
mix.sourceMaps();




