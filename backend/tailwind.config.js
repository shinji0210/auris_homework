/** @type {import('tailwindcss').Config} */
export default {
  //実際に使用されているクラスだけを抽出
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

