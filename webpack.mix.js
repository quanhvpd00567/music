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

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);
mix.js('resources/js/ajaxSetup.js', 'public/assets/js')
mix.js('resources/js/wa.js', 'public/end_user/js')
mix.js('resources/js/audio-animation.js', 'public/end_user/js')
mix.js('resources/js/audio-animation2.js', 'public/end_user/js')
    .sass('resources/css/common.scss', 'public/css')
    .sass('resources/css/audio.scss', 'public/end_user/css')
    .sass('resources/css/login.scss', 'public/end_user/css');

mix.styles([
    'resources/vietmix/stylesheets/css/bootstrap.min.css',
    'resources/vietmix/stylesheets/css/animate.css',
    'resources/vietmix/stylesheets/css/style.css',
    'resources/vietmix/stylesheets/css/responsive.css',
], 'public/vietmix/stylesheets/css/all.css');
mix.sass('resources/vietmix/stylesheets/css/common.scss', 'public/vietmix/stylesheets/css/');

// mix.copyDirectory('resources/vietmix', 'public/vietmix');


