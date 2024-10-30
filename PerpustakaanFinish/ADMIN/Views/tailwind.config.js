/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}"],
  theme: {
    extend: {
      fontFamily: {
        fontMain: "Manrope",
      },
      colors: {
        main: "#3E00FA",
        grey: "#404852",
        pink: "#FA003F",
        pinkSec: "#ECE6FF",
        secondary: "#B3B6BA",
        greenyellow: "#FDE616",
        secondaryBrigt: "#00FABB",
      },
    },
  },
  plugins: [],
}

