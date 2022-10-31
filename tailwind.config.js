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
      },
    },
  },
  plugins: [],
};
