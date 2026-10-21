# Wordpress-stack
Before start always run `npm i` or  `yarn install` to install all the required dependencies.

## Getting Started

Define the basic information of the theme and the domain of the text:
- `project-config.json`

Create env files from .env.sample.json:
- `.env.staging.json`
- `.env.production.json`

Run development command
```bash
npm run dev
or
yarn dev
```


## Advanced Commands

Run development command to the production environment
```bash
npm run dev-prod
or
yarn dev-prod
```

## Folder Structure

 * [assets](./assets/) #contains the static files to be included in the theme
   * [font](./assets/font) #fonts to be used
   * [js](./assets/js) #JS files that do not change over time
   * [vendors](./assets/vendors) #Vendor code to be included for not using external CDNs
 * [gulpcode](./gulpcode) #Contains the code used by the pre-processor
 * [build](./build) #Support folder used by Gulp to generate code to upload to server
 * [src](./src) #theme source code
   * [admin](./src/admin) #Contains the code regarding the Admin part of the theme
      * [cron](./src/admin/cron/) #Contains the definition of all cron set server-side
      * [pages](./src/admin/pages/) #Contains code for all custom admin pages
      * [script](./src/admin/script/) #Contains code for all scripts created for one-time actions
      * [init.admin.php](./src/admin/init.admin.php) #Contains registration of admin pages
   * [customposts](./src/customposts) #Contains statement of custom posts
   * [js](./src/js) #Contains all the JS files of the theme, at runtime they are concatenated and minified into a single file
   * [scss](./src/scss) #Contains all the SCSS files of the theme, at runtime they are concatenated and minified into a single file
   * [shortcodes](./src/shortcodes) #Contains statement of custom shortcodes
   * [template-parts](./src/template-parts) #Contains reusable template components in the theme
   * [templates](./src/templates) #Contains the page templates of the theme
   * [theme_settings](./src/theme_settings) #Contains the logic of the theme
 * [project-config.json](./project-config.json) #Contains the configuration of the theme's main css file, as well as the theme's domain declaration
 * [tailwind.config.js](./tailwind.config.js) Contains the Tailwind configuration used by the preprocessor


## Tailwind Advanced Config

To add the classes used in wordpress screens but not used in the stack files edit the file:
```bash
tailwind.config.js
```

## Notes on custom theme dynamics
```bash
...
```
