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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50:  '#fef2f2',
                    100: '#fee2e2',
                    500: '#f50606',
                    600: '#dc0505',
                    700: '#b91c1c',
                    800: '#991b1b',
                    900: '#7f1d1d',
                }
            }
        },
    },

    plugins: [forms],
};
