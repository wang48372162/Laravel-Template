let mix = require('laravel-mix');

mix.browserSync('localhost:8899');

mix.js('resources/assets/js/app.js', 'public/js')
  .extract([
    'vue',
    'jquery',
    'bootstrap',
    'popper.js',
    '@fortawesome/fontawesome',
    '@fortawesome/fontawesome-free-solid'
  ])
  .sass('resources/assets/sass/app.scss', 'public/css');

if (mix.inProduction()) {
  mix.version();
}
