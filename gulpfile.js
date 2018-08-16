/**
 * Gulpfile.
 *
 * Gulp with WordPress.
 *
 * Implements:
 *      1. Live reloads browser with BrowserSync.
 *      2. CSS: Sass to CSS conversion, error catching, Autoprefixing, Sourcemaps,
 *         CSS minification, and Merge Media Queries.
 *      3. JS: Concatenates & uglifies Vendor and JS files.
 *      4. Images: Minifies PNG, JPEG, GIF and SVG images.
 *      5. Watches files for changes in CSS or JS.
 *      6. Watches files for changes in PHP.
 *      7. Corrects the line endings.
 *      8. InjectCSS instead of browser page reload.
 *      9. Generates .pot file for i18n and l10n.
 *
 * @author Ahmad Awais (@ahmadawais)
 * @version 1.0.3
 */

/**
 * Configuration.
 *
 * Project Configuration for gulp tasks.
 *
 * In paths you can add <<glob or array of globs>>. Edit the variables as per your project requirements.
 */

// START Editing Project Variables.
// Project related.
var project = "Panda3D"; // Project Name.
var projectURL = "panda3d.test"; // Local project URL of your already running WordPress site. Could be something like local.dev or localhost:8888.
var productURL = "./"; // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder.

// Style related.
var styleSRC = "./assets/sass/style.scss"; // Path to main .scss file.
var styleDestination = "./"; // Path to place the compiled CSS file.

// JS related.
var jsSRC = "./assets/js/*.js"; // Path to JS scripts folder.
var jsDestination = "./"; // Path to place the compiled JS scripts file.
var jsFile = "bundle"; // Compiled JS file name.

// Images related.
var imagesSRC = "./assets/img/raw/**/*.{png,jpg,gif,svg}"; // Source folder of images which should be optimized.
var imagesDestination = "./assets/img/"; // Destination folder of optimized images. Must be different from the imagesSRC folder.

// Browsers you care about for autoprefixing.
// Browserlist https        ://github.com/ai/browserslist
const AUTOPREFIXER_BROWSERS = [
    "last 2 version",
    "> 1%",
    "ie >= 9",
    "ie_mob >= 10",
    "ff >= 30",
    "chrome >= 34",
    "safari >= 7",
    "opera >= 23",
    "ios >= 7",
    "android >= 4",
    "bb >= 10"
];

// STOP Editing Project Variables.

/**
 * Load Plugins.
 *
 * Load gulp plugins and passing them semantic names.
 */
var gulp = require("gulp"); // Gulp of-course

// CSS related plugins.
var sass = require("gulp-sass"); // Gulp pluign for Sass compilation.
var minifycss = require("gulp-uglifycss"); // Minifies CSS files.
var autoprefixer = require("gulp-autoprefixer"); // Autoprefixing magic.
var mmq = require("gulp-merge-media-queries"); // Combine matching media queries into one media query definition.

// JS related plugins.
var concat = require("gulp-concat"); // Concatenates JS files
var uglify = require("gulp-uglify"); // Minifies JS files

// Image realted plugins.
var imagemin = require("gulp-imagemin"); // Minify PNG, JPEG, GIF and SVG images with imagemin.

// Utility related plugins.
var rename = require("gulp-rename"); // Renames files E.g. style.css -> style.min.css
var lineec = require("gulp-line-ending-corrector"); // Consistent Line Endings for non UNIX systems. Gulp Plugin for Line Ending Corrector (A utility that makes sure your files have consistent line endings)
var filter = require("gulp-filter"); // Enables you to work on a subset of the original files by filtering them using globbing.
var sourcemaps = require("gulp-sourcemaps"); // Maps code in a compressed file (E.g. style.css) back to it’s original position in a source file (E.g. structure.scss, which was later combined with other css files to generate style.css)
var browserSync = require("browser-sync").create(); // Reloads browser and injects CSS. Time-saving synchronised browser testing.
var wpPot = require("gulp-wp-pot"); // For generating the .pot file.
var sort = require("gulp-sort"); // Recommended to prevent unnecessary changes in pot-file.

/**
 * Task: `browser-sync`.
 *
 * Live Reloads, CSS injections, Localhost tunneling.
 *
 * This task does the following:
 *    1. Sets the project URL
 *    2. Sets inject CSS
 *    3. You may define a custom port
 *    4. You may want to stop the browser from openning automatically
 */
gulp.task("browser-sync", function(done) {
    browserSync.init({
        // For more options
        // @link http://www.browsersync.io/docs/options/

        // Project URL.
        proxy: projectURL,

        // `true` Automatically open the browser with BrowserSync live server.
        // `false` Stop the browser from automatically opening.
        open: true,

        // Inject CSS changes.
        // Comment it to reload browser for every CSS change.
        injectChanges: true,

        // Use a specific port (instead of the one auto-detected by Browsersync).
        port: 8000
    });
    done();
});

/**
 * Task: `reload`.
 *
 * Manually reloads browser for changes that can't be injected.
 */
gulp.task("reload", function(done) {
    browserSync.reload();
    done();
});

/**
 * Task: `styles`.
 *
 * Compiles Sass, Autoprefixes it and Minifies CSS.
 *
 * This task does the following:
 *    1. Gets the source scss file
 *    2. Compiles Sass to CSS
 *    3. Writes Sourcemaps for it
 *    4. Autoprefixes it and generates style.css
 *    5. Renames the CSS file with suffix .min.css
 *    6. Minifies the CSS file and generates style.min.css
 *    7. Injects CSS or reloads the browser via browserSync
 */
gulp.task("styles", function() {
    return gulp
        .src(styleSRC)
        .pipe(sourcemaps.init())
        .pipe(
            sass({
                errLogToConsole: true,
                outputStyle: "compact",
                // outputStyle: 'compressed',
                // outputStyle: 'nested',
                // outputStyle: 'expanded',
                precision: 10
            })
        )
        .on("error", console.error.bind(console))
        .pipe(sourcemaps.write({ includeContent: false }))
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(autoprefixer(AUTOPREFIXER_BROWSERS))

        .pipe(sourcemaps.write("./"))
        .pipe(lineec()) // Consistent Line Endings for non UNIX systems.
        .pipe(gulp.dest(styleDestination))

        .pipe(filter("**/*.css")) // Filtering stream to only css files
        .pipe(mmq({ log: true })) // Merge Media Queries only for .min.css version.

        .pipe(browserSync.stream()) // Reloads style.css if that is enqueued.

        .pipe(rename({ suffix: ".min" }))
        .pipe(
            minifycss({
                maxLineLen: 10
            })
        )
        .pipe(lineec()) // Consistent Line Endings for non UNIX systems.
        .pipe(gulp.dest(styleDestination))

        .pipe(filter("**/*.css")) // Filtering stream to only css files
        .pipe(browserSync.stream()) // Reloads style.min.css if that is enqueued.
});

/**
 * Task: `bundleJS`.
 *
 * Concatenate and uglify JS scripts.
 *
 * This task does the following:
 *     1. Gets the source folder for JS files
 *     2. Concatenates all the files and generates bundle.js
 *     3. Renames the JS file with suffix .min.js
 *     4. Uglifes/Minifies the JS file and generates bundle.min.js
 */
gulp.task("bundleJS", function() {
    return gulp
        .src(jsSRC)
        .pipe(concat(jsFile + ".js"))
        .pipe(lineec()) // Consistent Line Endings for non UNIX systems.
        .pipe(gulp.dest(jsDestination))
        .pipe(
            rename({
                basename: jsFile,
                suffix: ".min"
            })
        )
        .pipe(uglify())
        .pipe(lineec()) // Consistent Line Endings for non UNIX systems.
        .pipe(gulp.dest(jsDestination))
});

/**
 * Task: `images`.
 *
 * Minifies PNG, JPEG, GIF and SVG images.
 *
 * This task does the following:
 *     1. Gets the source of images raw folder
 *     2. Minifies PNG, JPEG, GIF and SVG images
 *     3. Generates and saves the optimized images
 *
 * This task will run only once, if you want to run it
 * again, do it with the command `gulp images`.
 */
gulp.task("images", function() {
    return gulp
        .src(imagesSRC)
        .pipe(
            imagemin({
                progressive: true,
                optimizationLevel: 3, // 0-7 low-high
                interlaced: true,
                svgoPlugins: [{ removeViewBox: false }]
            })
        )
        .pipe(gulp.dest(imagesDestination))
});

/**
 * Watch Tasks.
 *
 * Watches for file changes and runs specific tasks.
 */
gulp.task(
    "default",
    gulp.series(
        gulp.parallel("styles", "bundleJS", "images"),
        "browser-sync",
        function() {
            gulp.watch("./**/*.php", gulp.series("reload")); // Reload on PHP file changes.
            gulp.watch("./assets/sass/**/*.scss", gulp.series("styles")); // Reload on SCSS file changes.
            gulp.watch("./assets/js/**/*.js", gulp.series("bundleJS", "reload")); // Reload on bundleJS file changes.
        }
    )
);
