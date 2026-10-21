var gulp = require('gulp');
var wpPot = require('gulp-wp-pot');
var del = require('del');
const fs = require('fs')

const { config, environment, themeBasePath, remote_base_path, rootPath } = require('./config');

//TRANSLATION
gulp.task('translate', function () {
  return gulp.src('src/**/*.php')
    .pipe(wpPot({}))
    .pipe(gulp.dest('locale/' + config.theme_text_domain + '.pot'));
});

//CLEAR BUILD FOLDER
gulp.task('clean', function () {
  console.log("Clean all files in build folder");
  return del([rootPath + '/build', rootPath + '/static_files_name.json'], { force: true });
});

gulp.task('generate-static-files-name', function () {
  //SET FILE NAMES
  const d = new Date();
  const pad = n => String(n).padStart(2, '0');
  const month = pad(d.getMonth() + 1),
    day = pad(d.getDate()),
    year = d.getFullYear(),
    hours = pad(d.getHours()),
    minutes = pad(d.getMinutes());

  const actualDate = year + "" + month + "" + day + "" + hours + "" + minutes;
  const pathFileNaming = rootPath + '/static_files_name.json'
  let cssName = 'main_' + actualDate + '.css';
  let jsName = 'main_' + actualDate + '.js';
  const static_files_name_content = JSON.stringify({
    'cssName': cssName,
    'jsName': jsName
  });
  console.log(static_files_name_content)
  fs.writeFileSync(pathFileNaming, static_files_name_content);
  return gulp.src('*.*', { read: false })
});

//CLEAR BUILD FOLDER
gulp.task('generate-folder-structure', function () {
  var fs = require('fs');
  const folders = [
    config.paths.build.folder,
    config.paths.build.folder + remote_base_path,
    config.paths.build.folder + remote_base_path + 'wp-content',
    config.paths.build.folder + remote_base_path + 'wp-content/plugins',
    config.paths.build.folder + remote_base_path + 'wp-content/themes',
    config.paths.build.folder + remote_base_path + 'wp-content/uploads',
  ];

  folders.forEach(dir => {
    if (!fs.existsSync(dir)) {
      fs.mkdirSync(dir, { recursive: true });
      console.log('📁  folder created:', dir);
    }
  });
  return gulp.src('*.*', { read: false })

});

//GENERATE FILE ROBOTS
gulp.task('generate-robotstxt', function (cb) {

  if (environment.ENV !== 'production') {
    let robotsTxtText = 'User-agent: *\nDisallow: /';
    var fs = require('fs');
    fs.writeFile(config.paths.build.folder + remote_base_path + 'robots.txt', robotsTxtText, cb);
  }

});

//GENERATE FILE STYLE.CSS
gulp.task('generate-stylecss', function (cb) {

  let template = "";
  if (config.themeinfo.template.length > 0) {
    template = "Template: " + config.themeinfo.template + '\n';
  }
  let textDomain = config.theme_text_domain;
  if ('text_domain' in config.themeinfo) {
    if (config.themeinfo['text_domain'].length > 0) {
      textDomain = config.themeinfo.text_domain
    }
  }
  let styleCssText = '/*\nTheme Name: ' + config.themeinfo.name + '\nAuthor: ' + config.themeinfo.author + '\nAuthor URI: ' + config.themeinfo.url + '\nText Domain: ' + textDomain + '\n' + template + '*/';
  var fs = require('fs');
  fs.writeFile(themeBasePath + '/style.css', styleCssText, cb);

});
