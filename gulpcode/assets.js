var gulp = require('gulp');
const { config, themeBasePath } = require('./config');


//copia tutti i file dell'assets nella cartella della build
gulp.task('copy-assets', function () {
  return gulp.src([config.paths.assets.allfiles]).pipe(gulp.dest(themeBasePath + config.paths.build.assets));
});