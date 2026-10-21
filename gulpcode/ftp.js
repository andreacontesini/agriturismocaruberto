const gulp = require('gulp');
const ftp = require('vinyl-ftp');
const { ftpConfig } = require('./config');
const gutil = require('gulp-util');


gulp.task('upload-files', () => {

  ftpConfig.log = gutil.log;
  var conn = ftp.create(ftpConfig);
  return gulp.src(["build/**"], {
    buffer: true,
    reload: true
  })
    .pipe(conn.newerOrDifferentSize("/")) // only upload newer files
    .pipe(conn.dest("/"));

});