const gulp = require('gulp');
const concat = require('gulp-concat');
const sort = require('gulp-sort');
const stripDebug = require('gulp-strip-debug');
const uglify = require('gulp-uglify-es').default;
const { config, environment, rootPath, themeBasePath } = require('./config');


gulp.task('scripts', function () {

  const pathFileNaming = rootPath + '/static_files_name.json'
  const static_files_name = require(pathFileNaming);
  const jsName = static_files_name.jsName;
  if (environment.ENV === 'production'){
    return gulp.src(config.paths.src.js.watch)
      .pipe(sort())
      .pipe(concat(jsName))
      .pipe(stripDebug())
      .pipe(uglify())
      .pipe(gulp.dest(themeBasePath + config.paths.build.js));
  }
  return gulp.src(config.paths.src.js.watch)
    .pipe(sort())
    .pipe(concat(jsName))
    .pipe(gulp.dest(themeBasePath + config.paths.build.js));
  
});