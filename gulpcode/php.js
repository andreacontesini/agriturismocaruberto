const gulp = require('gulp');
const replace = require('gulp-replace');
const sort = require('gulp-sort');
const concat = require('gulp-concat');

const { config, staticFilesUrl, themeBasePath, rootPath } = require('./config');

gulp.task('generate-php-files', function () {

  const pathFileNaming = rootPath + '/static_files_name.json'
  const static_files_name = require(pathFileNaming);
  const cssName = static_files_name.cssName;
  const jsName = static_files_name.jsName;

  return gulp.src(config.paths.src.html.watch)
    .pipe(replace('src="/', 'src="' + staticFilesUrl + '/'))
    .pipe(replace('src="./', 'src="' + staticFilesUrl + '/'))
    .pipe(replace('src=\'/', 'src=\'' + staticFilesUrl + '/'))
    .pipe(replace('src=\'./', 'src=\'' + staticFilesUrl + '/'))
    .pipe(replace('src="assets/', 'src="' + staticFilesUrl + '/assets/'))
    .pipe(replace('href="/', 'href="' + staticFilesUrl + '/'))
    .pipe(replace('href="./', 'href="' + staticFilesUrl + '/'))
    .pipe(replace('href="assets/', 'href="' + staticFilesUrl + '/assets/'))
    .pipe(replace('src=\'assets/', 'src=\'' + staticFilesUrl + '/assets/'))
    .pipe(replace('href=\'/', 'href=\'' + staticFilesUrl + '/'))
    .pipe(replace('href=\'./', 'href=\'' + staticFilesUrl + '/'))
    .pipe(replace('href=\'assets/', 'href=\'' + staticFilesUrl + '/assets/'))
    .pipe(replace("_themename", config.theme_text_domain))
    .pipe(replace("###main_css_filename###", cssName))
    .pipe(replace("###main_js_filename###", jsName))
    .pipe(gulp.dest(themeBasePath));

  //NOTE: @alessio sostituire tutte le stringhe di testo con: <?php __("TESTO DA TRADURRE(IN INGLESE)", "_themename");?>
});


gulp.task('generate-functions-file', function () {

  const pathFileNaming = rootPath + '/static_files_name.json'
  const static_files_name = require(pathFileNaming);
  const cssName = static_files_name.cssName;
  const jsName = static_files_name.jsName;

  return gulp.src(["src/customposts/*.php", "src/shortcodes/*.php", "src/vc_components/*.php", "src/theme_settings/*.php", "src/api/*.php", "src/functions.php"])
    .pipe(sort())
    .pipe(concat("functions.php"))
    .pipe(replace('?><?php', ''))
    .pipe(replace('?><?php', ''))
    .pipe(replace('?>\n<?php', ''))
    .pipe(replace('?>\n\n<?php', ''))
    .pipe(replace('?>\n\n\n<?php', ''))
    .pipe(replace('?>\n\n\n\n<?php', ''))
    .pipe(replace('src="/', 'src="' + staticFilesUrl + '/'))
    .pipe(replace('src="./', 'src="' + staticFilesUrl + '/'))
    .pipe(replace('src=\'/', 'src=\'' + staticFilesUrl + '/'))
    .pipe(replace('src=\'./', 'src=\'' + staticFilesUrl + '/'))
    .pipe(replace('src="assets/', 'src="' + staticFilesUrl + '/assets/'))
    .pipe(replace('href="/', 'href="' + staticFilesUrl + '/'))
    .pipe(replace('href="./', 'href="' + staticFilesUrl + '/'))
    .pipe(replace('href="assets/', 'href="' + staticFilesUrl + '/assets/'))
    .pipe(replace('src=\'assets/', 'src=\'' + staticFilesUrl + '/assets/'))
    .pipe(replace('href=\'/', 'href=\'' + staticFilesUrl + '/'))
    .pipe(replace('href=\'./', 'href=\'' + staticFilesUrl + '/'))
    .pipe(replace('href=\'assets/', 'href=\'' + staticFilesUrl + '/assets/'))
    .pipe(replace("_themename", config.theme_text_domain))
    .pipe(replace("###main_css_filename###", cssName))
    .pipe(replace("###main_js_filename###", jsName))
    .pipe(gulp.dest(themeBasePath));

});