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
                sans: ['Plus Jakarta Sans', 'Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    bg: '#F4F4F4',
                    primary: '#4C8AFF',
                    'primary-dark': '#3568D4',
                    accent: '#FFFC4C',
                    dark: '#1E293B',
                    muted: '#64748B',
                }
            }
        },
    },

    plugins: [forms],
};