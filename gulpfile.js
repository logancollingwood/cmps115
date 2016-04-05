// Gulpfile.js
// touched Mar 31

var gulp = require('gulp');
var less = require('gulp-less');
var path = require('path');
var minify = require('gulp-minify');
var concat = require('gulp-concat');
var react = require('gulp-react');
var browserify = require('browserify');
var uglify = require('gulp-uglify');

var path = {
  HTML: 'src/index.html',
  LESS: 'resources/assets/less/*.less',
  ALL: ['resources/assets/js/*.js'],
  JS: ['resources/assets/js/*.js'],
  MINIFIED_OUT: 'build.min.js',
  DEST_SRC: 'public/js/compiled',
  DEST_BUILD: 'public/js/build',
  DEST: 'dist'
};


gulp.task('less', function () {
  return gulp.src('./resources/assets/less/*.less')
    .pipe(less({
      paths: [ path.join(__dirname, 'less', 'includes') ]
    }))
    .pipe(gulp.dest('./public/css'));
});

gulp.task('build', function(){
  gulp.src(path.JS)
    .pipe(react())
    .pipe(concat(path.MINIFIED_OUT))
    .pipe(uglify(path.MINIFIED_OUT))
    .pipe(gulp.dest(path.DEST_BUILD));
});


// Rerun the task when a file changes
gulp.task('watch', function() {
  gulp.watch(path.JS, ['build']);
  gulp.watch(path.LESS, ['less']);
});