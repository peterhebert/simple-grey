// Grab our gulp packages
var gulp  = require('gulp'),
    sass = require('gulp-sass')(require('sass')),
    autoprefixer = require('gulp-autoprefixer'),
    nano = require('gulp-cssnano'),
    concat = require('gulp-concat'),
    rename = require('gulp-rename'),
    replace = require('gulp-replace'),
    merge = require('merge-stream'),
    wpPot = require('gulp-wp-pot'),
    sort = require('gulp-sort'),
    rtlcss = require('gulp-rtlcss');

// compile and minify SCSS to CSS
function styles() {
  return gulp.src('./scss/**/*.scss')
    .pipe(sass({
      outputStyle: 'expanded'
    }).on('error', sass.logError))
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(gulp.dest('./css'))
    .pipe(nano({ discardComments: { removeAll: true, discardEmpty: true } }))
    .pipe(rename({ suffix: '-min' })) // Append "-min" to the filename.
    .pipe(gulp.dest('./css')); // Output MINIMIZED stylesheets.
}
exports.styles = styles;

// compile and minify SCSS to rtl CSS
function styles_rtl () {
  return gulp.src('./scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({ browsers: ['last 2 versions'], cascade: false }))
    .pipe(rtlcss())
    .pipe(nano({ discardComments: { removeAll: true, discardEmpty: true } }))
    .pipe(rename({
      suffix: '-rtl'
    }))
    .pipe(gulp.dest('./css'));
}
exports.styles_rtl = styles_rtl;

// copy icon fonts from node_modules dir
function icons() {
   return gulp.src('./node_modules/fork-awesome/fonts/**/*')
          .pipe(gulp.dest('./fonts/'));
}
exports.icons = icons;

// generate .pot files for translation
function translate() {
  return gulp.src('./**/*.php')
    .pipe(sort())
    .pipe(wpPot( {
      domain: 'simple-grey',
      destFile:'simple-grey.pot',
      bugReport: 'https://github.com/peterhebert/simple-grey/issues',
      lastTranslator: 'Peter Hebert <peter@peterhebert.com>',
      headers: false
    } ))
    .pipe(replace(/([0-9]{4}) simple-grey/, '$1 Peter Hebert'))
    .pipe(replace('same license as the simple-grey package', 'GNU General Public License v2 or later'))
    .pipe(gulp.dest('languages'));

}
exports.translate = translate;

// Watch files for changes
const watchStyles = () => gulp.watch('./scss/**/*.scss', gulp.parallel(styles, styles_rtl) );

// Create a default task
const dev = gulp.series(
  gulp.parallel(styles, styles_rtl, icons),
  watchStyles
);
exports.default = dev;

exports.build = gulp.series(
  gulp.parallel( styles, styles_rtl, icons  ),
  translate
);