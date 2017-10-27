const { mix } = require('laravel-mix');

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
mix.sass('resources/assets/sass/app.scss', 'public/css')
   .js('resources/assets/js/app.js', 'public/js');

mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js');
mix.copy('node_modules/foundation-sites/dist/js/foundation.min.js', 'public/js');

// mix.js([
//    'node_modules/foundation-sites/dist/js/foundation.min.js',
//    'resources/assets/js/app.js'
// ], 'public/js/app.js');