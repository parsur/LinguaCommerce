const mix = require('laravel-mix');

// mix.setPublicPath('public'); // in public_html
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
    // .js('resources/assets/js/react', 'public/js/reactJs').react()
    // ckeditor
    .js('resources/assets/js/ckeditor/ckeditor.js', 'public/js/ckeditor/ckeditor.js')
    // ckeditor initialization
    .js('resources/assets/js/ckeditor/ckeditorInit.js', 'public/js/ckeditor/ckeditorInit.js')
    // ckeditor(read only) initialization
    .js('resources/assets/js/ckeditor/ckeditorInitReadOnly.js', 'public/js/ckeditor/ckeditorInitReadOnly.js')
    // Comment Submission
    .js('resources/assets/js/commentSubmission.js', 'public/js/commentSubmission.js')
    // Image preview
    .js('resources/assets/js/imagePreview.js', 'public/js/imagePreview.js')
    // Subcategories based on categories
    .js('resources/assets/js/subCategoryWithCategory.js', 'public/js/subCategoryWithCategory.js')
    // Ajax Request Handler
    .copy('resources/assets/js/ImageHandler.js', 'public/js/ImageHandler.js')
    // Ajax Request Handler
    .copy('resources/assets/js/RequestHandler.js', 'public/js/RequestHandler.js')
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
    .css('resources/assets/css/ckeditor.css', 'public/css/ckeditor.css')
    // App Sass
    .sass('resources/assets/sass/app.scss','public/css');

mix.sourceMaps();




