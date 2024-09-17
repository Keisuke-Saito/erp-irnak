const mix = require('laravel-mix')

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

 // エイリアスの登録
 mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      'vue$': 'vue/dist/vue.esm.js',
      '@': __dirname + '/web/src'
    }
  },
})

if (!mix.inProduction()) {
  require('laravel-mix-eslint')
  mix.eslint({
    fix: true,
    extensions: ['vue']
  })
}

mix
  .js('web/src/main.js', 'public/js')
  .vue({ version: 2 })
