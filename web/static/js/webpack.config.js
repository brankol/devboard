var path = require('path');
var webpack = require('webpack');

module.exports = {
    resolve: {
        root: __dirname + '/src'
    },
    entry: [
        'babel-polyfill',
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
