// Gulpfile.js
// touched Mar 31

var less = require('gulp-less');
var path = require('path');



gulp.task('less', function () {
  return gulp.src('./resources/assets/less/*.less')
    .pipe(less({
      paths: [ path.join(__dirname, 'less', 'includes') ]
    }))
    .pipe(gulp.dest('./public/css'));
});