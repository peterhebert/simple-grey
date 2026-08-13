// Grab our gulp packages
var gulp  = require('gulp');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var cssnano = require('cssnano');
var sass = require('gulp-sass')(require('sass'));
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var replace = require('gulp-replace');
var merge = require('merge-stream');
var sort = require('gulp-sort');
var rtlcss = require('gulp-rtlcss');

const plugins = [
  autoprefixer(),
  cssnano({ discardComments: { removeAll: true, discardEmpty: true } })
];

// compile and minify SCSS to CSS
function styles() {

  return gulp.src('./scss/**/*.scss')
    .pipe(sass({
      outputStyle: 'expanded'
    }).on('error', sass.logError))
    .pipe(gulp.dest('./css'))
    .pipe(postcss(plugins))
    .pipe(rename({ suffix: '-min' })) // Append "-min" to the filename.
    .pipe(gulp.dest('./css')); // Output MINIMIZED stylesheets.
}
exports.styles = styles;

// compile and minify SCSS to rtl CSS
function styles_rtl () {
  return gulp.src('./scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(rtlcss())
    .pipe(postcss(plugins))
    .pipe(rename({
      suffix: '-rtl'
    }))
    .pipe(gulp.dest('./css'));
}
exports.styles_rtl = styles_rtl;

// Watch files for changes
const watchStyles = () => gulp.watch('./scss/**/*.scss', gulp.parallel(styles, styles_rtl) );

// Create a default task
const dev = gulp.series(
  gulp.parallel(styles, styles_rtl),
  watchStyles
);
exports.default = dev;

exports.build = gulp.series(
  gulp.parallel( styles, styles_rtl )
);