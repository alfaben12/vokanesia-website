const mix = require('laravel-mix');
const webpack = require('webpack');

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
  mix.webpackConfig({
    plugins: [
      new webpack.ProvidePlugin({
          '$': 'jquery',
          'jQuery': 'jquery',
          'window.jQuery': 'jquery',
      }),
    ],
    resolve : {
        alias : {
            'TweenLite' : 'upturn/js/TweenLite.min.js'
        }
    }
  });
 
  mix.copyDirectory('upturn/fonts', 'public/fonts');

mix
.js([
    'upturn/js/plugins.js',
    'resources/js/app.js',
    // 'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'upturn/js/jquery.magnific-popup.min.js',
    'upturn/js/owl.carousel.min.js',
    'upturn/js/jquery.ajaxchimp.min.js',
    'upturn/js/jquery.waypoints.min.js',
    'upturn/js/isotope.pkgd.min.js',
    'upturn/js/scrollax.js',
    'upturn/js/TweenLite.min.js',
    'upturn/js/jquery.themepunch.revolution.min.js',
    // 'upturn/js/jquery.themepunch.tools.min.js',
    'upturn/js/extensions/revolution.extension.slideanims.min.js',
    'upturn/js/extensions/revolution.extension.layeranimation.min.js',
    'upturn/js/extensions/revolution.extension.navigation.min.js',
    'upturn/js/extensions/revolution.extension.parallax.min.js',
    'upturn/js/jquery.easypiechart.min.js',
    'upturn/js/delighters.js',
    'upturn/js/slick.js',
    'upturn/js/main.js',
    'upturn/js/custom.js',
    'upturn/js/form.js',
], 'public/js/app.js')
.styles([
    'upturn/css/font-awesome.min.css',
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'upturn/css/animate.css',
    'upturn/css/iconfont.css',
    'upturn/css/magnific-popup.css',
    'upturn/css/owl.carousel.min.css',
    'upturn/css/owl.theme.default.min.css',
    'upturn/css/rev-settings.css',
    'upturn/css/plugins.css',
    'upturn/css/style.css',
    'upturn/css/responsive.css',
    'upturn/css/slick.css',
    'upturn/css/slick-theme.css',
], 'public/css/app.css');
