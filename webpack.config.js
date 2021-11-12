const path = require('path')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const HtmlWebpackHarddiskPlugin = require('html-webpack-harddisk-plugin')
const MiniCssExtractPlugin = require("mini-css-extract-plugin")

console.log(path.resolve(__dirname, './frontend/index.html.twig'))

module.exports = (env, options) => {
  const isProd = options.mode === 'production'
  const isDev = !isProd

  const plugins = () => {
    const plugins = [
      new MiniCssExtractPlugin({
        filename: '[name].[contenthash].css',
      }),
      new HtmlWebpackPlugin({
        title: options.mode,
        template: path.resolve(__dirname, './frontend/index.html.twig'),
        filename: path.resolve(__dirname, './templates/index.html.twig'),
        favicon: './frontend/favicon.svg',
        alwaysWriteToDisk: true
      }),
      new HtmlWebpackHarddiskPlugin(),
    ]

    if (isDev) {
      plugins.push(new MiniCssExtractPlugin({
        filename: "[name].[contenthash].css",
        chunkFilename: "[id].[contenthash].css",
      }));
    }

    return plugins
  }

  const cssLoaders = () => {
    return [
      isProd ? MiniCssExtractPlugin.loader : "style-loader",
      'css-loader'
    ]
  }

  return {
    //target: isDev ? 'web' : ['web', 'es5'],
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
    // devtool: isDev ? 'inline-source-map' : false,
    devServer: {
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
    },
    plugins: plugins(),
    module: {
      rules: [
        {
          test: /\.css$/i,
          include: path.resolve(__dirname, './frontend'),
          use: cssLoaders(),
        },
        {
          test: /\.(png|svg|jpg|jpeg|gif)$/i,
          include: path.resolve(__dirname, './frontend'),
          type: 'asset/resource',
        },
      ],
    }
  }
}
