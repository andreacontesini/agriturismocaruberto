const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const purgecss = require('gulp-purgecss');
const tailwindcss = require('tailwindcss'); 
const { config, rootPath, themeBasePath } = require('./config');
const tailwindConfig = require('../tailwind.config');

function handleSassError(err) {
  console.log(err.toString())
  process.exit(-1)
}

gulp.task('sass', function () {

  const pathFileNaming = rootPath + '/static_files_name.json'
  const static_files_name = require(pathFileNaming);
  const cssName = static_files_name.cssName;
  
  return gulp.src(config.paths.src.scss.watch)
    .pipe(sass().on('error', handleSassError))
    .pipe(gulp.dest(config.paths.src.scss.folder))
    .pipe(postcss([

      tailwindcss(tailwindConfig), 
      autoprefixer({
      overrideBrowserslist: ['last 2 versions']
      })
    ]))
    // .pipe(purgecss({
    //   content: ['src/**/*.{html,js,php}'],
    //   defaultExtractor: content => {
    //     const broadMatches = content.match(/[^<>"'`\s]*[^<>"'`\s:]/g) || []
    //     const innerMatches = content.match(/[^<>"'`\s.()]*[^<>"'`\s.():]/g) || []
    //     return broadMatches.concat(innerMatches)
    //   }
    // }))
    .pipe(cleanCSS({
      // level 0 = solo minificazione degli spazi.
      // Da level 1 in su clean-css 4.x elimina le dichiarazioni di custom
      // property con valore vuoto (--tw-gradient-from-position: ;, --tw-pan-x: ;,
      // --tw-blur: ;, --tw-ring-inset: ; ...) che Tailwind emette nel layer base.
      // Senza quelle inizializzazioni le var() che le usano diventano invalide
      // a computed-value time e gradienti/filtri/ring non vengono renderizzati.
      level: 0
    }))
    .pipe(concat(cssName))
    .pipe(gulp.dest(themeBasePath + config.paths.build.css));
});
