const rootPath = process.cwd();

module.exports = {
  mode: 'jit', // Just-In-Time Compiler
  content: [rootPath + '/src/**/*.html', rootPath + '/src/**/*.js', rootPath + '/src/**/*.php'],
  darkMode: 'media', // or 'media' or 'class'
  theme: {
    fontFamily: {
      'inter': ['Inter', 'Helvetica', 'Arial', 'sans-serif'],
    },
    extend: {
      colors: {
        'one': '#E9D7B8',
        'two': '#C99E67',
        'three': '#443025',
        'four': '#787050',
      },
    }
  },
  variants: {
    extend: {},
  },
  safelist: []
}