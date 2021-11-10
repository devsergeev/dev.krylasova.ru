const path = require('path')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const HtmlWebpackHarddiskPlugin = require('html-webpack-harddisk-plugin')

module.exports = (env, options) => {
  const isProd = options.mode === 'production'
  const isDev = !isProd

  return {
    //target: isDev ? 'web' : ['web', 'es5'],
    entry: {
      index: './src/index.js',
      print: './src/print.js',
    },
    output: {
      filename: '[name].bundle.js',
      path: path.resolve(__dirname, '../backend/public/assets'),
      publicPath: '/assets/',
      clean: true,
    },
    devServer: {
      client: {
        overlay: true,
        progress: true,
      },
      static: {
        directory: path.resolve(__dirname, '../backend/public/assets'),
        publicPath: '/assets/',
      },
      port: 3000,
      hot: false,
      liveReload: true,
      proxy: {
        path: '**',
        target: 'http://dev.krylasova.local',
        secure: false,
      },
    },
    plugins: [
      new HtmlWebpackPlugin({
        title: options.mode,
        template: path.resolve(__dirname, './src/index.html.twig'),
        filename: path.resolve(__dirname, '../backend/templates/index.html.twig'),
        favicon: './src/favicon.svg',
        alwaysWriteToDisk: true
      }),
      new HtmlWebpackHarddiskPlugin()
    ],
    devtool: isDev ? 'inline-source-map' : false,
    module: {
      rules: [
        {
          test: /\.css$/i,
          use: ['style-loader', 'css-loader'],
        },
        {
          test: /\.(png|svg|jpg|jpeg|gif)$/i,
          type: 'asset/resource',
        },
      ],
    }
  }
}
