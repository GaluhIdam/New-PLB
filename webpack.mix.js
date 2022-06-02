const mix = require('laravel-mix');

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
module.exports = {
    //...
    resolve: {
        symlinks: false
    }
};
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .vue()
    .copy(
        // 'node_modules/admin-lte/dist/img',
        // 'public/img',
        'node_modules/@fortawesome/fontawesome-free/webfonts',
        'public/webfonts',
    );