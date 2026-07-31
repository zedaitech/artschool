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
                    // Sampled from public/images/logo.png: the Guru's robe runs
                    // #f08100 -> #faab01 and the medallion field is #fcd787. The
                    // old #d4a017 was duller and more olive than the crest.
                    gold: '#e9a20c',
                    'gold-bright': '#faab01',
                    'gold-amber': '#f08100',
                    'gold-light': '#fcd787',
                    'gold-pale': '#fdeec6',
                    'gold-soft': '#faf3e0',
                    // Dark amber for small text (eyebrows, chips). Checked against
                    // every surface it lands on: 5.9:1 on white, 5.5:1 on cream,
                    // 5.1:1 on the gold-pale tint band — all clear of 4.5:1.
                    'gold-deep': '#8a5a08',
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
            // Colour-opacity modifiers only compile for values on this scale, so
            // the in-between steps the design uses (border-brand-ink/8,
            // text-brand-ink/65, bg-brand-cream/98 …) have to be declared here.
            // Without them Tailwind emits nothing at all and the utility is
            // silently dropped — an invisible border, or a see-through panel.
            opacity: {
                8: '0.08',
                15: '0.15',
                45: '0.45',
                55: '0.55',
                65: '0.65',
                85: '0.85',
                98: '0.98',
            },
            boxShadow: {
                soft: '0 20px 60px -20px rgba(122, 31, 34, 0.25)',
                gold: '0 10px 40px -10px rgba(250, 171, 1, 0.45)',
            },
            backgroundImage: {
                // Mirrors the medallion: deep robe amber into the pale field and back.
                'gold-gradient': 'linear-gradient(135deg, #f08100 0%, #fcd787 50%, #e9a20c 100%)',
                'gold-wash': 'linear-gradient(180deg, #fdeec6 0%, #faf3e0 55%, #fbf7ee 100%)',
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
