const START = process.env.WEBPACK_COMMAND === 'start'

const MODE = process.env.NODE_ENV
const PROD = MODE === 'production'

const path = require('path')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const MiniCssExtractPlugin = PROD && require('mini-css-extract-plugin')
const HtmlWebpackHarddiskPlugin = START && require('html-webpack-harddisk-plugin')
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin')

module.exports = () => {

  const config = {
    mode: MODE,
    entry: {
      index: './src/index.js',
    },
    resolve: {
      extensions: ["*", ".js", ".jsx"],
    },
    output: {
      filename: '[name].js?v=[contenthash]',
      path: path.resolve(__dirname, './dist/assets'),
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
      minimizer: [
        '...',
        new CssMinimizerPlugin(),
      ],
    },
    plugins: [
      new HtmlWebpackPlugin({
        template: path.resolve(__dirname, './src/templates/layouts/main.html.twig'),
        filename: path.resolve(__dirname, './dist/templates/site/layouts/main.html.twig'),
        favicon: './src/favicon.svg',
        alwaysWriteToDisk: true
      }),
    ],
    module: {
      rules: [
        {
          test: /\.(js|jsx)$/,
          loader: "babel-loader",
          options: {
            presets: ["@babel/env"],
          }
        },
        {
          test: /\.css$/i,
          use: [
            PROD ? MiniCssExtractPlugin.loader : "style-loader",
            'css-loader',
          ],
        },
        {
          test: /\.(png|svg|jpg|jpeg|gif)$/i,
          include: path.resolve(__dirname, './src'),
          type: 'asset/resource',
        },
      ],
    }
  }

  if (START) {
    config.devServer = {
      allowedHosts: 'all',
      client: {
        overlay: true,
        progress: true,
      },
      static: {
        directory: path.resolve(__dirname, './dist/public/assets'),
        publicPath: '/assets/',
      },
      port: 80,
      hot: true,
      liveReload: true,
      proxy: {
        path: '**',
        target: 'http://php-apache',
        secure: false,
      },
    }
  }

  if (START) {
    config.plugins.push(new HtmlWebpackHarddiskPlugin())
  }

  if (PROD) {
    config.plugins.push(new MiniCssExtractPlugin({
      filename: "[name].css?v=[contenthash]",
      chunkFilename: "[id].css?v=[contenthash]",
    }))
  }

  return config
}
