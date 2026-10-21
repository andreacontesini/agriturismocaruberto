const { series, parallel } = require('gulp');
var gulp = require('gulp');
var contains = require('gulp-contains');
const jshint = require('gulp-jshint');
const stylish = require('jshint-stylish');
const phplint = require("phplint").lint;
var through = require('through2');



const { siteUrlStaging, siteUrlProduction } = require('./config');


gulp.task("validate-php", function (cb) {
  phplint(
    ["src/**/*.php"],
    { limit: 10 },
    function (err, stdout, stderr) {
      if (err) {
        cb(err);
      } else {
        console.log('✅  passed php files tests');    
        cb();
      }
    }
  );
});

gulp.task("validate-build-php", function (cb) {
  phplint(
    ["build/**/*.php"],
    { limit: 10 },
    function (err, stdout, stderr) {
      if (err) {
        cb(err);
      } else {
        console.log('✅  passed php files tests');    
        cb();
      }
    }
  );
});

gulp.task("log-correct-urls-checks", function (cb) {  
  console.log('✅  passed staging url check');    
  console.log('✅  passed production url check');    
  cb();
});


//VALIDATE PHP CODE

//VALIDATE JS CODE
gulp.task('validate-js', function (cb) {
  return gulp.src('src/**/*.js')
        .pipe(jshint({esnext: true}))
        .pipe(jshint.reporter('jshint-stylish'))
        .pipe(jshint.reporter('fail'))
        .pipe(through.obj(function (chunk, enc, cb) {
          console.log('✅  passed javascript files tests');    
          cb();
        }))
});

//Check for staging url
gulp.task('check-staging-url', function () {
  return gulp.src('src/**')
    .pipe(contains({
      search: siteUrlStaging,
      onFound: function (string, file, cb) {
        console.log('found ' + siteUrlStaging + ' in ' + file.path)
        process.exit(1)//se trovo dei pro
      }
    }))
});

//Check for production url
gulp.task('check-production-url', function () {
  return gulp.src('src/**')
    .pipe(contains({
      search: siteUrlProduction,
      onFound: function (string, file, cb) {
        console.log('found ' + siteUrlProduction + ' in ' + file.path)
        process.exit(1)//se trovo dei pro
      }
    }));
});

