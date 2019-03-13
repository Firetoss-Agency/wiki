const mix     = require('laravel-mix');
const webpack = require("webpack");

// Set project paths
const localDomain = 'uikit.test';
const themePath   = 'wp-content/themes/spark';
const assetsPath  = `${themePath}/resources`;
const publicPath  = `${themePath}/public`;

mix
// Add jQuery globally
.webpackConfig({
  plugins: [
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      "window.jQuery": "jquery"
    })
  ]
})

// Suppress success messages
.disableSuccessNotifications()

// Set Mix Configs
.setPublicPath(publicPath)
.setResourceRoot(`${themePath}/resources`)

// Compile Javascript (ES6)
.js(`${assetsPath}/js/main.js`, `${publicPath}/js`)

// Compile Sass
.standaloneSass(`${assetsPath}/scss/main.scss`, `${publicPath}/css`, {
  includedPaths: ['node_modules']
})
.sourceMaps()

// Setup BrowserSync
.browserSync({
  proxy: localDomain,
  host: localDomain,
  notify: false,
  open: false,
  reloadOnRestart: true,
  injectChanges: true,
  files: [
    `${themePath}/**/*.php`,
    `${publicPath}/**/*.js`,
    `${publicPath}/**/*.css`
  ]
})

// Setup versioning (cache-busting)
if (mix.inProduction()) {
  mix.version();
  mix.babel(`${publicPath}/js/main.js`, `${publicPath}/js/main.js`);
}
