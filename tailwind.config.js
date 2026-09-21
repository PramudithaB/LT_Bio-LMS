import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#fff1ee',
                    100: '#ffe4dd',
                    200: '#ffccbe',
                    300: '#ffa792',
                    400: '#ff7355',
                    500: '#F53003',
                    600: '#dc2602',
                    700: '#b81d00',
                    800: '#941a04',
                    900: '#7a1908',
                    DEFAULT: '#F53003',
                },
                bio: {
                    50: '#eefbfc',
                    100: '#d5f5f7',
                    500: '#17a2b8',
                    600: '#117a8b',
                    700: '#0c5c6a',
                    DEFAULT: '#17a2b8',
                },
                'primary-purple': '#F53003',
                'dark-purple': '#dc2602',
                'light-purple': '#ffe4dd',
                'accent-yellow': '#facc15',
            },
        },
    },

    plugins: [forms],
};
