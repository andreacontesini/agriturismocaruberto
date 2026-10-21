'use strict';

const { series, parallel, watch } = require('gulp');
const gulp = require('gulp');
const through = require('through2');
const { config, ftpConfig, environment, staticFilesUrl, themeBasePath, rootPath } = require('./gulpcode/config');
const ftp = require('vinyl-ftp');
const gutil = require('gulp-util');
const replace = require('gulp-replace');
const sort = require('gulp-sort');
const concat = require('gulp-concat');

require('./gulpcode/config')
require('./gulpcode/assets')
require('./gulpcode/css')
require('./gulpcode/generic')
require('./gulpcode/php')
require('./gulpcode/scripts')
require('./gulpcode/tests')
require('./gulpcode/security')
require('./gulpcode/ftp')




gulp.task('deploy-theme', series(
  'clean',
  'generate-static-files-name',
  'generate-folder-structure',
  parallel('sass', 'scripts', 'copy-assets'),
  'translate',
  parallel('generate-php-files', 'generate-functions-file'),
  'generate-stylecss'
)
);


gulp.task('run-tests',
  series(
    // parallel('check-staging-url', 'check-production-url'),
    // 'log-correct-urls-checks',
    'deploy-theme',
    // 'validate-build-php',
    // 'validate-js'
  )
);

gulp.task('run-tests-pre-commit',
  series(
    parallel('check-staging-url', 'check-production-url'),
    'log-correct-urls-checks',
    'validate-php',
    'validate-js'
  )
);



gulp.task('deploy',
  series(
    'run-tests',//GENERO LA CARTELLA ED ESEGUO TUTTI I TEST
    'generate-security',//GENERO IL FILE DI CONFIGURAZIONE DELLA SICUREZZA
    'upload-files', //CARICO TUTTI I FILE
  )
);
//'upload-files', 

gulp.task('watch', series('run-tests', 'generate-security', 'upload-files', function (cb) {

  ftpConfig.log = gutil.log;
  var conn = ftp.create(ftpConfig);

  const pathFileNaming = rootPath + '/static_files_name.json'
  const static_files_name = require(pathFileNaming);
  const cssName = static_files_name.cssName;
  const jsName = static_files_name.jsName;

  //SCSS FILES
  watch(config.paths.src.scss.watch, series(
    'sass',
    function (cb) {
      //UPLOAD FILE
      gulp.src(["build/**/dist/css/*.css"], {
        buffer: true,
        reload: true
      })
        .pipe(replace("_themename", config.theme_text_domain))
        .pipe(conn.newerOrDifferentSize("/")) // only upload newer files
        .pipe(conn.dest("/"));
      cb();
    }
  ));

  //JS FILES
  watch(config.paths.src.js.watch, series(
    'scripts',
    'sass',
    function (cb) {
      //UPLOAD FILE

      gulp.src(["build/**/dist/js/*.js"], {
        buffer: true,
        reload: true
      })
        .pipe(replace("_themename", config.theme_text_domain))
        .pipe(conn.newerOrDifferentSize("/")) // only upload newer files
        .pipe(conn.dest("/"));
      cb();
    }
  ));

  //PHP FILES
  watch("src/**/*.php", series('sass'));
  watch("src/**/*.php").on('change', function (file) {
    var filePath = file;
    console.log(filePath);
    var filename = filePath.replace(/^.*[\\\/]/, '');
    var destPath = file;
    var pathTemp = process.cwd();
    destPath = destPath.replace("src", themeBasePath);
    destPath = destPath.replace("build", '');
    destPath = destPath.replace("\\", "/");
    destPath = destPath.replace(filename, '');
    console.log('filename: ', filename)
    console.log('destPath: ', destPath)
    if (
      filePath.indexOf("\\vc_components\\") !== -1 ||
      filePath.indexOf("\\theme_settings\\") !== -1 ||
      filePath.indexOf("\\shortcodes\\") !== -1 ||
      filePath.indexOf("\\customposts\\") !== -1 ||
      filePath.indexOf("\\api\\") !== -1 ||
      filePath.indexOf("\\functions.php") !== -1 ||
      filePath.indexOf("/vc_components/") !== -1 ||
      filePath.indexOf("/theme_settings/") !== -1 ||
      filePath.indexOf("/shortcodes/") !== -1 ||
      filePath.indexOf("/customposts/") !== -1 ||
      filePath.indexOf("/api/") !== -1 ||
      filePath.indexOf("/functions.php") !== -1
    ) {
      let destPathFunction = themeBasePath.replace('/build/', '/').replace('build/', '/')
      console.log("file functions.php");
      gulp.src(["src/customposts/*.php", "src/shortcodes/*.php", "src/vc_components/*.php", "src/theme_settings/*.php", "src/api/*.php", "src/functions.php"])
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
        .pipe(conn.newerOrDifferentSize("/")) // only upload newer files
        .pipe(conn.dest(destPathFunction));

    } else {
      //UPLOAD FILE
      gulp.src(filePath, {
        buffer: true,
        reload: true
      })
        .pipe(concat(filename))
        .pipe(replace("_themename", config.theme_text_domain))
        .pipe(replace("###main_css_filename###", cssName))
        .pipe(replace("###main_js_filename###", jsName))
        .pipe(conn.newerOrDifferentSize("/")) // only upload newer files
        .pipe(conn.dest(destPath));
    }

    cb();

  });
}));