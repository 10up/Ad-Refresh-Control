const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const path = require( 'path' );

module.exports = {
	...defaultConfig,
	module: {
		...defaultConfig.module,
	},
	entry: {
		"js/frontend": "./assets/js/frontend/frontend.js"
	},
	output: {
		path: path.resolve( __dirname, 'dist' )
	}
};
