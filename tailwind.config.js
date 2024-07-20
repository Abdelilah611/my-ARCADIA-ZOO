/** @type {import('tailwindcss').Config} */

const plugin = require('tailwindcss/plugin')

module.exports = {
  content: ['./assets/**/*.js', './templates/**/*.html.twig'],
  theme: {
    extend: {
      colors: {
        myWhite: '#FCFBF7',
        myBlack: '#021708',
        primGreen: '#1F5906',
        secBrown: '#73370D',
        savaneBG: '#F7EAE1',
        jungleBG: '#0C2402',
        maraisBG: '#F5FCF2',
        lightHeader: '#FAD5BB',
        darkHeader: '#73370D',
        lightLink: '#FAD5BB',
        danger: '#B52921',
        lightDanger: '#F78C86',
        success: '#055E1B',
        lightSuccess: '#4AF074',
      },
      textShadow: {
        sm: '0 1px 2px var(--tw-shadow-color)',
        DEFAULT: '0 4px 4px var(--tw-shadow-color)',
        lg: '0 8px 12px var(--tw-shadow-color)',
      },
    },
    fontFamily: {
      header: ['"Aclonica", sans-serif'],
      body: ['Optima, Candara, "Noto Sans", source-sans-pro, sans-serif;'],
    },
  },
  plugins: [
    plugin(function ({ matchUtilities, theme }) {
      matchUtilities(
        {
          'text-shadow': (value) => ({
            textShadow: value,
          }),
        },
        { values: theme('textShadow') }
      )
    }),
  ],
}
