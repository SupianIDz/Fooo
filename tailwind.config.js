/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.js',
        './resources/**/*.blade.php',
        './node_modules/flowbite/**/*.js'
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('flowbite/plugin'),
        require('tailwind-scrollbar'),
    ],
}
