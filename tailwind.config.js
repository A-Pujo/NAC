module.exports = {
  purge: {
    enabled: false,
    content: [
      './app/**/*.php',
    ],
    options: {
      safelist: [
        /data-theme$/,
      ]
    },
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        primary: {
          400: '#162856',
          300: '#2C549A',
          200: '#3A6FCC',
          100: '#488BFF',
          80: '#74A6FE',
          60: '#8CB6FE',
          40: '#B2CEFE',
        },
        secondary: {
          400: '#00414D',
          300: '#006C80',
          200: '#0292AC',
          100: '#1BB7CD',
          80: '#54C2D1',
          60: '#82CED9',
          40: '#B8E0E6',
        },
        neutral: {
          400: '#020715',
          300: '#06102E',
          200: '#0D193E',
          100: '#162555',
          80: '#1E3273',
          60: '#284399',
        },
        base: {
          500: '#D0D0D0',
          400: '#E3E5E6',
          300: '#EEF0F0',
          200: '#F8FAFA',
          100: '#FCFEFF',
          80: '#FFFFFF',
        },
      },
      spacing: {
        'auto' : 'auto',
        '4' : '4px',
        '8' : '8px',
        '14' : '14px',
        '16' : '16px',
        '24' : '24px',
        '32' : '32px',
        '48' : '48px',
        '56' : '56px',
        '64' : '64px',
        '96' : '96px',
        '112' : '112px',
        '120' : '120px',
        '144' : '144px',
        '163' : '163px',
        '235' : '235px',
        '279' : '279px',
        '287' : '287px',
        '300' : '300px',
        '311' : '311px',
        '370' : '370px',
        '554' : '554px',
        '560' : '560px',
        '590' : '590px',
        '640' : '640px',
      },
      fontSize: {
        '10' : '10px',
        '14' : '14px',
        '16' : '16px',
        '18' : '18px',
        '24' : '24px',
        '36' : '36px',
        '64' : '64px',
      },
      inset:{
        '32' : '32px',
        'timeline' : 'calc(50% - (279px/2))',
      },
      letterSpacing:{
        '6.5' : '0.065',
        '30' : '0.3'
      },
      maxWidth : {
        '1000' : '1000px'
      },
      transitionProperty:{
        'collapse' : 'height, padding'
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('daisyui'),
  ],
  daisyui: {
    themes: [
      {
        'dark': {
          'primary': '#2C549A',
          'primary-focus': '#3A6FCC',
          'primary-content': '#D0D0D0',

          'secondary': '#006C80',
          'secondary-focus': '#0292AC',
          'secondary-content': '#D0D0D0',

          'neutral': '#06102E',
          'neutral-focus': '#0D193E',
          'neutral-content': '#D0D0D0',

          'base-100': '#E3E5E6',
          'base-200': '#EEF0F0',
          'base-300': '#F8FAFA',
          'base-content': '#1f2937',

          'info': '#2094f3',
          'success': '#009485',
          'warning': '#ff9900',
          'error': '#ff5724',
        }
      }
    ]
  },
}
