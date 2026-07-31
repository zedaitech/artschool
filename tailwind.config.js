import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import aspectRatio from '@tailwindcss/aspect-ratio';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './app/Filament/**/*.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                // Brand palette derived from the school crest.
                brand: {
                    maroon: '#7a1f22',
                    'maroon-dark': '#5c1315',
                    gold: '#d4a017',
                    'gold-light': '#f2d98a',
                    'gold-soft': '#faf3e0',
                    saffron: '#f39c12',
                    green: '#2f6b3a',
                    'green-dark': '#1f4a28',
                    cream: '#fbf7ee',
                    ink: '#2b2320',
                },
            },
            fontFamily: {
                serif: ['"Cormorant Garamond"', 'Georgia', ...defaultTheme.fontFamily.serif],
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                display: ['"Marcellus"', 'Georgia', 'serif'],
                // Anek Kannada is drawn for screen text; Noto Serif Kannada is the
                // display face that stands in for Marcellus, which has no Kannada.
                kannada: ['"Anek Kannada"', '"Noto Sans Kannada"', ...defaultTheme.fontFamily.sans],
                'kannada-display': ['"Noto Serif Kannada"', '"Anek Kannada"', 'serif'],
            },
            boxShadow: {
                soft: '0 20px 60px -20px rgba(122, 31, 34, 0.25)',
                gold: '0 10px 40px -10px rgba(212, 160, 23, 0.45)',
            },
            backgroundImage: {
                'gold-gradient': 'linear-gradient(135deg, #d4a017 0%, #f2d98a 50%, #d4a017 100%)',
                'maroon-gradient': 'linear-gradient(135deg, #7a1f22 0%, #5c1315 100%)',
            },
            keyframes: {
                'fade-up': {
                    '0%': { opacity: '0', transform: 'translateY(24px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'fade-in': {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-12px)' },
                },
            },
            animation: {
                'fade-up': 'fade-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                'fade-in': 'fade-in 1s ease forwards',
                float: 'float 6s ease-in-out infinite',
            },
        },
    },
    plugins: [forms, typography, aspectRatio],
};
