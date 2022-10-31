/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './src/**/*.{html,js,php}',
    './index.php',
    './recipe/**/*.{html,js,php}',
    './login/**/*.{html,js,php}',
    './dashboard/**/*.{html,js,php}',
    './edit/**/*.{html,js,php}',
  ],
  theme: {
    extend: {
      colors: {
        'lemon-milk': '#e1eba4',
        coffee: '#1f2120',
        cream: '#b1b3b5',
        warning: '#c24444',
      },
    },
  },
  plugins: [],
};
