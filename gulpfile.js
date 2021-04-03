//defining base path
const basePaths = {
	node: './node_modules/',
	scss_admin: './admin/css/sass/',
	scss_public: './public/css/sass/',
	scripts_admin: './admin/js/src/',
	scripts_public: './public/js/src/',
	distAssets_admin: './admin/',
	distAssets_public: './public/',
};

// Defining requirements
const { src, dest, parallel} = require('gulp');
const concat      = require('gulp-concat');
const sass        = require('gulp-sass');
const cleanCSS	= require('gulp-clean-css');
const sourcemaps	= require('gulp-sourcemaps');
const minify		= require('gulp-minify');
const browsersync = require('browser-sync');

// browser-sync watched files
const browserSyncWatchFiles = [
    basePaths.distAssets_admin +'css/*.css',
	basePaths.distAssets_admin +'js/*.js',
	basePaths.distAssets_public +'css/*.css',
    basePaths.distAssets_public +'js/*.js',
];

// browser-sync options

// Convert sass to css for admin side
function StylesAdmin (){
	return src([
		basePaths.scss_admin + '*.scss'
		])
	.pipe( sass( {style: 'compressed'} ).on('error', sass.logError) )
	.pipe(cleanCSS({debug: true}, function(details) {
		console.log(details.name + ': ' + (details.stats.originalSize / 1000) + 'KB' );
		console.log(details.name + ': ' + (details.stats.minifiedSize / 1000) + 'KB' );
	}))
	.pipe( dest( basePaths.distAssets_admin + 'css/' ) );
};

// Convert sass to css for admin side
function StyelPublic (){
	return src([
		basePaths.scss_public + '*.scss'
		])
	.pipe( sass( {style: 'compressed'} ).on('error', sass.logError) )
	.pipe(cleanCSS({debug: true}, function(details) {
		console.log(details.name + ': ' + (details.stats.originalSize / 1000) + 'KB' );
		console.log(details.name + ': ' + (details.stats.minifiedSize / 1000) + 'KB' );
	}))
	.pipe( dest( basePaths.distAssets_public + 'css/' ) );
};


// minify javascript for admin side
function ScriptAdmin(){
	return src([
		basePaths.scripts_admin + '*.js'
	])
	.pipe( minify() )
	.pipe( dest( basePaths.distAssets_admin + 'js/'  ) );
};

// minify javascript for public side
function ScriptPublic( ){
	return src([
		basePaths.scripts_public + '*.js'
	])
	.pipe( minify() )
	.pipe( dest( basePaths.distAssets_public + 'js/'  ) );
};

exports.styeladmin = StylesAdmin;
exports.stylepublic = StyelPublic;
exports.scriptadmin = ScriptAdmin;
exports.scriptpublic = ScriptPublic;

exports.styles = parallel( this.styeladmin, this.stylepublic );
exports.scripts = parallel( this.scriptadmin, this.scriptpublic );

exports.default = parallel( this.styles, this.scripts );
