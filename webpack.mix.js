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

mix.js('resources/js/admin/app.js', 'public/js/admin')
    .extract(['vue']);
mix.sass('resources/sass/admin/app.scss', 'public/css/admin')
.sass('resources/sass/admin/toastr.scss', 'public/css/admin');

mix.combine([
	'resources/packages/fancybox/css/jquery.fancybox.min.css',
	'resources/packages/spinkit/css/spinkit.min.css',
	'resources/css/admin/main.css'
], 'public/css/admin/main.css');

mix.combine([
	'resources/packages/fancybox/js/jquery.fancybox.min.js',
	'resources/js/admin/main.js'
], 'public/js/admin/main.js');

// web css
mix.combine([
	'resources/packages/spinkit/css/spinkit.min.css'
], 'public/css/web/app.css');

mix.combine([
	'resources/css/web/reset.css',
	'resources/css/web/fonts.css',
	'resources/css/web/packages.min.css',
	'resources/css/web/theme.css',
	'resources/css/web/main.css'
], 'public/css/web/main.css');

// web js
mix.combine([
	'resources/js/web/vendor.js'
], 'public/js/web/app.js');

mix.combine([
	'resources/packages/axios/js/axios.min.js',
	'resources/packages/vue/js/vue.min.js',
	'resources/js/web/modernizr.min.js',
	'resources/js/web/packages.min.js',
	'resources/js/web/theme.js'
], 'public/js/web/main.js');