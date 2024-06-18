const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const path = require( 'path' );

module.exports = {
	...defaultConfig,
	entry: {
		...defaultConfig.entries,
		'js/frontend': './assets/js/frontend/frontend.js'
	},
	output: {
		path: path.resolve( __dirname, 'dist' )
	}
};