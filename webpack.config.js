const START = process.env.WEBPACK_COMMAND === 'start'

const MODE = process.env.NODE_ENV
const PROD = MODE === 'production'

const path = require('path')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const MiniCssExtractPlugin = PROD && require("mini-css-extract-plugin")
const HtmlWebpackHarddiskPlugin = START && require('html-webpack-harddisk-plugin')

module.exports = () => {

  const config = {
    mode: MODE,
    entry: {
      index: './frontend/index.js',
    },
    output: {
      filename: '[name].[contenthash].js',
      path: path.resolve(__dirname, './public/assets'),
      publicPath: '/assets/',
      clean: true,
    },
    optimization: {
      moduleIds: 'deterministic',
      runtimeChunk: 'single',
      splitChunks: {
        cacheGroups: {
          vendor: {
            test: /[\\/]node_modules[\\/]/,
            name: 'vendors',
            chunks: 'all',
          },
        },
      },
    },
    plugins: [
      new HtmlWebpackPlugin({
        title: MODE,
        template: path.resolve(__dirname, './frontend/index.html.twig'),
        filename: path.resolve(__dirname, './templates/index.html.twig'),
        favicon: './frontend/favicon.svg',
        alwaysWriteToDisk: true
      }),
    ],
    module: {
      rules: [
        {
          test: /\.css$/i,
          include: path.resolve(__dirname, './frontend'),
          use: [
            PROD ? MiniCssExtractPlugin.loader : "style-loader",
            'css-loader'
          ],
        },
        {
          test: /\.(png|svg|jpg|jpeg|gif)$/i,
          include: path.resolve(__dirname, './frontend'),
          type: 'asset/resource',
        },
      ],
    }
  }

  if (START) {
    config.devServer = {
      client: {
        overlay: true,
        progress: true,
      },
      static: {
        directory: path.resolve(__dirname, './public/assets'),
        publicPath: '/assets/',
      },
      port: 3000,
      hot: true,
      liveReload: false,
      proxy: {
        path: '**',
        target: 'http://dev.krylasova.local',
        secure: false,
      },
    }
  }

  if (START) {
    config.plugins.push(new HtmlWebpackHarddiskPlugin())
  }

  if (PROD) {
    config.plugins.push(new MiniCssExtractPlugin({
      filename: "[name].[contenthash].css",
      chunkFilename: "[id].[contenthash].css",
    }))
  }

  return config
}
