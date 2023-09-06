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
var wpPot = require('gulp-wp-pot');
var sort = require('gulp-sort');
var rtlcss = require('gulp-rtlcss');

const plugins = [
  autoprefixer({
    browsers: ['last 2 versions'],
    cascade: false
  }),
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