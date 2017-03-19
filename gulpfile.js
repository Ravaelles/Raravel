const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

//elixir((mix) => {
//    mix.sass('app.scss')
//            .webpack('app.js');
//});

elixir((mix) => {

    // === SASS ================================================================

    // SASS - app
    mix.sass([
        'app/*.scss'
    ], 'public/css/app.min.css');

    // SASS - vendor
    mix.sass([
        'vendor/bootstrap.css',
        'vendor/sb-admin.css',
        'vendor/*',
    ], 'public/css/vendor.min.css');

    // === Scripts =============================================================

    // Scripts - app
    mix.scripts([
        'app/*.js'
    ], 'public/js/app.min.js');

    // Scripts - vendor
    mix.scripts([
        'vendor/jquery.js',
        'vendor/*',
    ], 'public/js/vendor.min.js');

});