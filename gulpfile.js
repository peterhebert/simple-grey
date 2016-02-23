// Grab our gulp packages
var gulp  = require('gulp'),
    less = require('gulp-less'),
    autoprefixer = require('gulp-autoprefixer'),
    nano = require('gulp-cssnano'),
    concat = require('gulp-concat'),
    rename = require('gulp-rename'),
    replace = require('gulp-replace'),
    merge = require('merge-stream'),
    wpPot = require('gulp-wp-pot');


// Create a default task
gulp.task('default', function() {
  gulp.start('styles', 'font-awesome');
});

// Watch files for changes
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch('./less/**/*.less', ['styles']);

});

// compile and minify LESS to CSS
gulp.task('styles', function() {
    return gulp.src(['./less/editor.less', './less/simple-grey.less'])
        .pipe(less())
        .pipe(autoprefixer({
    			browsers: ['last 2 versions'],
    			cascade: false
    		}))
        .pipe(nano({discardComments: {removeAll: true}}))
        .pipe(gulp.dest('./css'));
});

// copy FontAwesome from node_modules dir
gulp.task('font-awesome', function() {

   return gulp.src('./node_modules/font-awesome/fonts/**/*')
          .pipe(gulp.dest('./fonts/'));

});
