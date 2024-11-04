/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    fontSize: {
      xs: '0.6rem',
      sm: '0.8rem',
      base: '1rem',
      lg: '1.25rem',
      xl: '1.563rem',
      '2xl': '1.953rem',
      '3xl': '2.441rem',
      '4xl': '3.052rem'
    },
    extend: {
      maxWidth: {
        maxSite: "1440px",
      },
      fontFamily: {
        sans: ['"Roboto Flex"', 'sans-serif'],
      },
    },
  },
  plugins: [],
}

