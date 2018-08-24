// Grab our gulp packages
var gulp  = require('gulp'),
    less = require('gulp-less'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    nano = require('gulp-cssnano'),
    concat = require('gulp-concat'),
    rename = require('gulp-rename'),
    replace = require('gulp-replace'),
    merge = require('merge-stream'),
    wpPot = require('gulp-wp-pot'),
    sort = require('gulp-sort'),
    rtlcss = require('gulp-rtlcss');


// Create a default task
gulp.task('default', function() {
  gulp.start('styles', 'font-awesome', 'watch');
});

// Watch files for changes
gulp.task('watch', function () {
  gulp.watch('./less/**/*.less', ['less', 'less-rtl']);
  gulp.watch('./scss/**/*.scss', ['sass', 'sass-rtl']);
});

// compile and minify LESS to CSS
gulp.task('less', function () {
  return gulp.src(['./less/editor.less', './less/simple-grey.less'])
    .pipe(less())
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(gulp.dest('./css'))
    .pipe(nano({
      discardComments: {
        removeAll: true,
        discardEmpty: true
      }
    }))
    .pipe(rename({
      suffix: '-min'
    })) // Append "-min" to the filename.
    .pipe(gulp.dest('./css')); // Output RTL stylesheets.
});

// compile and minify LESS to CSS - rtl versions
gulp.task('less-rtl', function () {
  return gulp.src(['./less/editor.less', './less/simple-grey.less'])
    .pipe(less())
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(nano({
      discardComments: {
        removeAll: true,
        discardEmpty: true
      }
    }))
    .pipe(rtlcss()) // Convert to RTL.
    .pipe(rename({
      suffix: '-rtl'
    })) // Append "-rtl" to the filename.
    .pipe(gulp.dest('./css')); // Output RTL stylesheets.
});

// compile and minify SCSS to CSS
gulp.task('sass', function () {
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
});

// compile and minify SCSS to rtl CSS
gulp.task('sass-rtl', function () {
  return gulp.src('./scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({ browsers: ['last 2 versions'], cascade: false }))
    .pipe(rtlcss())
    .pipe(nano({ discardComments: { removeAll: true, discardEmpty: true } }))
    .pipe(rename({
      suffix: '-rtl'
    }))
    .pipe(gulp.dest('./css'));
});


// copy FontAwesome from node_modules dir
gulp.task('font-awesome', function() {

   return gulp.src('./node_modules/font-awesome/fonts/**/*')
          .pipe(gulp.dest('./fonts/'));

});

// generate .pot files for translation
gulp.task('translation', function () {
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
});
