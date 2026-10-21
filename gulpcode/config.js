var argv = require('yargs').argv;

var rootPath = process.cwd();

const isProduction = (argv.production === undefined) ? false : true;
const unlockWP = ( argv.unlock === undefined) ? false : true;



//READ GENERIC CONFIG
const config = require(rootPath + '/project-config.json');

//GENERATE ENVIRONMENT CONFIG
let environment = {}
let siteUrlStaging = '';
let siteUrlProduction = '';
if(isProduction){
  environment = require(rootPath + '/.env.production.json');
  const environmentStaging = require(rootPath + '/.env.staging.json');
  siteUrlProduction = environment.SITE_URL;
  siteUrlStaging = environmentStaging.SITE_URL;
}else{
  environment = require(rootPath + '/.env.staging.json');
  const environmentProduction = require(rootPath + '/.env.production.json');
  siteUrlStaging = environment.SITE_URL;
  siteUrlProduction = environmentProduction.SITE_URL;
}
let remote_base_path = '';
if (environment.FTP_BASE_PATH.length > 0){
  remote_base_path = environment.FTP_BASE_PATH + '/';
}
const themeBasePath = config.paths.build.folder + remote_base_path + 'wp-content/themes/' + config.theme_text_domain;
console.log(themeBasePath)
let staticFilesUrl = environment.COMPLETE_SITE_URL;
if(environment.CDN_URL.length > 0){
  staticFilesUrl = environment.CDN_URL;
}

//CREATE FTP CONFIG
const ftpConfig = {
  "user": environment.FTP_USER,
  "password": environment.FTP_PASS,
  "host": environment.FTP_HOST,
  "port": environment.FTP_PORT,
  "localRoot": "build",
  "remoteRoot": ".",
  "startFolder": "",
  "include": [
    "tmp/**/*.*",
  ],
  "exclude": [
  ],
  "deleteRemote": true,
  "forcePasv": true,
  "parallel": 1
};

module.exports = {
  config,
  environment,
  siteUrlStaging,
  siteUrlProduction,
  staticFilesUrl,
  themeBasePath,
  unlockWP,
  ftpConfig,
  remote_base_path,
  rootPath
}