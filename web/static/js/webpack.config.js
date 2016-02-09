var path = require('path');
var webpack = require('webpack');

module.exports = {
    resolve: {
        root: __dirname + '/src'
    },
    // babel-polyfill includes A LOT of polyfills and since we're using only Promises (for axios)
    // I commented it out to make the bundle lighter. es6-promise is included manually instead.
    entry: [
        // 'babel-polyfill',
        __dirname + '/src/index'
    ],
    output: {
        path: path.join(__dirname, 'build'),
        filename: 'bundle.js',
        publicPath: '/' // This is used to generate URLs to e.g. images
    },
    module: {
        loaders: [
            {
                loader: 'babel-loader',

                // Skip any files outside of your project's `src` directory
                include: [
                    path.resolve(__dirname, 'src'),
                ],

                // Only run `.js` files through Babel
                test: /\.js$/,

                // Options to configure babel with
                query: {
                    plugins: ['transform-runtime'],
                    presets: ['es2015', 'react'],
                }
            }
        ]
    }
};
