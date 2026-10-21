var gulp = require('gulp');
const { unlockWP, environment, config, remote_base_path } = require('./config');

//GENERATE FILE ROBOTS
gulp.task('generate-security', function (cb) {

  let securityContent = '<?php\n';
  if(environment.ENV === 'production'){

    securityContent += 'define("WP_DEBUG", false);\n';
    securityContent += 'define("WP_DEBUG_LOG", false);\n';
    securityContent += 'define("WP_DEBUG_DISPLAY", false);\n';

    securityContent += "//Disable wordpress auto update\n";
    securityContent += "define( 'WP_AUTO_UPDATE_CORE', false );\n";
    if(unlockWP){
      securityContent += "//Disable Editing Theme/Plugins Files\n"; 
      securityContent += "//define('DISALLOW_FILE_EDIT',true);\n";
      securityContent += "//Prevent Users From Installing or Updating Plugin & Themes\n";
      securityContent += "//define('DISALLOW_FILE_MODS',true);\n";
      securityContent += "define('FS_METHOD', 'direct');\n";
    }else{
      securityContent += "//Disable Editing Theme/Plugins Files\n"; 
      securityContent += "define('DISALLOW_FILE_EDIT',true);\n";
      securityContent += "//Prevent Users From Installing or Updating Plugin & Themes\n";
      securityContent += "define('DISALLOW_FILE_MODS',true);\n";
      securityContent += "//define('FS_METHOD', 'direct');\n";
    }
    
  }else{
    securityContent += 'define("WP_DEBUG", true);\n';
    securityContent += 'define("WP_DEBUG_LOG", true);\n';
    securityContent += 'define("WP_DEBUG_DISPLAY", false);\n';
  }
  securityContent += "?>";
  var fs = require('fs');

  //write security rules
  // writeFileSync: con fs.writeFile + cb multipli Gulp 4 va in errore ("callback called multiple times")
  fs.writeFileSync(config.paths.build.folder + remote_base_path + 'security.php', securityContent);

  if(environment.ENV !== 'production'){
    //clear debug file
    fs.writeFileSync(config.paths.build.folder + remote_base_path + 'wp-content/debug.log', '');
  }

  //secure folders
  fs.writeFileSync(config.paths.build.folder + remote_base_path + 'wp-content/plugins/.htaccess', '# Deny PHP Execution\n<Files *.php>\ndeny from all\n</Files>');
  fs.writeFileSync(config.paths.build.folder + remote_base_path + 'wp-content/uploads/.htaccess', '# Deny PHP Execution\n<Files *.php>\ndeny from all\n</Files>');
  cb();
});

