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
    .sourceMaps()
    .options({
        postCss: [require('autoprefixer')]
    });

const path = require('path');
mix.webpackConfig({
    resolve: {
        alias: {
            '@resources': path.resolve(__dirname, 'resources/'),
            '@': path.resolve(__dirname, 'resources/js/src/'),
            '@axios': path.resolve(__dirname, 'resources/js/src/libs/axios')
        }
    }
});