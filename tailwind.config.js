import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import daisyui from 'daisyui';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
    ],

    theme: {
        extend: {
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins'],
            },
            colors: {
                pelorous: {
                    DEFAULT: "#39A1C8",
                    300: '#7FCCE9',
                    500: '#39A1C8',
                    700: '#1F5B71',
                },
                apple: {
                    DEFAULT: "#53BD41",
                    300: '#61DE75',
                    500: '#53BD41',
                    700: '#2E6A24',
                },
                'selective-yellow': {
                    DEFAULT: '#FFBA06',
                    300: '#F9D26F',
                    500: '#FFBA06',
                    700: '#956C00',
                },
                'fuzzy-brown': {
                    DEFAULT: "#C94C4A",
                    300: '#FF7472',
                    500: '#C94C4A',
                    700: '#7D2725',
                },
                indigo: {
                    DEFAULT: "#3A6FBE",
                    300: '#6398E8',
                    500: '#3A6FBE',
                    700: '#203D68',
                },
                'twilight-blue': {
                    DEFAULT: "#F3FEFF"
                },
                'ct-grey': {
                    DEFAULT: "#363636",
                },
                'curious-blue': {
                    DEFAULT: "#2A8AC9",
                    300: '#66AFDF',
                    500: '#2A8AC9',
                    700: '#174A6C',
                },
                'green': {
                    DEFAULT: "#28a745"
                }
            },
        },
    },

    daisyui: {
        themes: [
            {
                mytheme: {
                    "primary": "#2887C6",
                    "secondary": "#f000b8",
                    "accent": "#1dcdbc",
                    "neutral": "#2b3440",
                    "base-100": "#ffffff",
                    "info": "#3abff8",
                    "success": "#36d399",
                    "warning": "#fbbd23",
                    "error": "#f87272",
                },
            },
        ],
    },

    plugins: [daisyui, forms({ strategy: 'class' })],
};
