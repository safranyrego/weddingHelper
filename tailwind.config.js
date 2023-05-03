const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php', 
        './vendor/filament/**/*.blade.php'
    ],

    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1rem',
                sm: '1.5rem',
                lg: '2rem',
            },
        },
        screens: {
            'sm': '500px',
            'md': '992px',
            'lg': '1440px',
        },
        extend: {
            height: {
                200: '200px',
            },
            maxWidth: {
                500: '500px',
                992: '992px',
                1080: '1080px',
                1440: '1440px',
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            },
        }
    },

    safelist: [
        'hidden',
        'sm:max-w-500',
        'md:max-w-992',
        'lg:max-w-1080',
    ],

    plugins: [require('@tailwindcss/forms')],
};
