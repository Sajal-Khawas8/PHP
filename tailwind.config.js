const defaultTheme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,php,js}"],
  theme: {
    extend: {
      fontFamily: {
        'openSans': ['"Open Sans"', 'sans-serif', ...defaultTheme.fontFamily.sans]
      }
    },
  },
  plugins: [],
}

