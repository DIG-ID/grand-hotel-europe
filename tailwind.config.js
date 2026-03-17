/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './front-page.php',
    './header.php',
    './index.php',
    './footer.php',
    './404.php',
    './inc/*.php',
    './page-templates/**/*.php',
    './template-parts/**/*.php',
  ],
  theme: {
    fontFamily: {
      gilda: ['Gilda Display', 'serif'],
      barlow: ['barlow', 'sans-serif'],
      source: ['source-serif-4', 'serif'],
      barlowCondensed: ['barlow-condensed', 'sans-serif'],
    },

    extend: {
      letterSpacing: {
        //wide: '.038em',
        //wider: '.06em',
      },
      colors: {
        'darker': '#25211E',
        'dark': '#333333',
        'dark-2': '#222222',
        'gold': '#A7986E',
        'cream': '#F8F5F0',
      },
      transitionTimingFunction: {
        //'out-expo': 'cubic-bezier(0.16, 1, 0.3, 1)',
      },
      gridTemplateRows: {
        // Allow grid rows to auto size based on content
        'masonry': 'masonry',
      },
    },
  },
  plugins: [
  ],
}
