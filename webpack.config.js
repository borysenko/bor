const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const options = {};
var path = require('path');

module.exports = {
    entry: {
        main: ['./asset/main.js', './asset/main.css'],
    },
    plugins: [
        new WebpackManifestPlugin(options),
        new MiniCssExtractPlugin({
            filename: '[name].css'
        }),
    ],
    output: {
        publicPath: "js",
        path: path.resolve(__dirname, './web/js'),
        filename: 'bundle.js'
    },
    mode: 'development',
    module: {
        rules: [
            {
                test: /\.(css|sass)$/,
                use: ['style-loader','css-loader', 'sass-loader']
            }
        ],
    }
};