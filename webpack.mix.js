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

mix.js('resources/assets/js/app/app.js', 'public/js')
    .sass('resources/assets/sass/app/layout.scss', 'public/css/app.min.css');
    // .postCss('resources/assets/css/app.css', 'public/css/app.min.css', [
    // ]);

mix.js('resources/assets/js/vendor/bootstrap.js', 'public/js/vendor.min.js');
mix.js('resources/assets/js/vendor/jquery.js', 'public/js/vendor.min.js');

// mix.postCss('resources/assets/sass/vendor/bootstrap.css', 'public/css/vendor.min.css');
mix.postCss('resources/assets/sass/vendor/sb-admin.css', 'public/css/vendor.min.css');

// mix.postCss(
//     'resources/assets/sass/vendor/sb-admin.css',
//     'public/css/vendor.min.css'
// );
