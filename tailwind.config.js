const rootPath = process.cwd();

module.exports = {
  mode: 'jit', // Just-In-Time Compiler
  content: [rootPath + '/src/**/*.html', rootPath + '/src/**/*.js', rootPath + '/src/**/*.php'],
  darkMode: 'media', // or 'media' or 'class'
  theme: {
    fontFamily: {
      'inter': ['Inter', 'Helvetica', 'Arial', 'sans-serif'],
      'custom': ['Circular', 'Helvetica', 'Arial', 'sans-serif'],
    },
    extend: {
      colors: {
        'primary': '#0B6087',
        'secondary': '#fe8944',
      },
    }
  },
  variants: {
    extend: {},
  },
  safelist: []
}