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
                // Horizon Sentinel Navy/Sea Theme Colors
                primary: {
                    50: '#f0f4f8',
                    100: '#d9e2ec',
                    200: '#bcccdc',
                    300: '#9fb3c8',
                    400: '#829ab1',
                    500: '#627d98',
                    600: '#486581',
                    700: '#334e68',
                    800: '#1A3D64', // Muted Blue
                    900: '#0C2B4E', // Dark Blue
                    950: '#051a2e',
                },
                secondary: {
                    50: '#f0f7fa',
                    100: '#d0e7f0',
                    200: '#a1cfe1',
                    300: '#72b7d2',
                    400: '#439fc3',
                    500: '#1D546C', // Dark Teal/Blue-Green
                    600: '#174358',
                    700: '#113244',
                    800: '#0b2130',
                    900: '#05101c',
                    950: '#02080c',
                },
                accent: {
                    50: '#f8f8f8',
                    100: '#f4f4f4', // Off-White
                    200: '#e8e8e8',
                    300: '#d1d1d1',
                    400: '#b8b8b8',
                    500: '#9f9f9f',
                    600: '#868686',
                    700: '#6d6d6d',
                    800: '#545454',
                    900: '#3b3b3b',
                    950: '#222222',
                },
                horizon: {
                    light: '#f4f4f4',
                    DEFAULT: '#1A3D64',
                    dark: '#0C2B4E',
                    sea: '#1D546C',
                    gradient: {
                        from: '#0C2B4E',
                        via: '#1A3D64',
                        to: '#1D546C',
                    },
                },
            },
            backgroundImage: {
                'gradient-horizon': 'linear-gradient(135deg, #0C2B4E 0%, #1A3D64 50%, #1D546C 100%)',
                'gradient-horizon-soft': 'linear-gradient(135deg, #f4f4f4 0%, #e8e8e8 50%, #d9e2ec 100%)',
                'gradient-navy': 'linear-gradient(135deg, #0C2B4E 0%, #1A3D64 100%)',
                'gradient-sea': 'linear-gradient(135deg, #1A3D64 0%, #1D546C 100%)',
                'gradient-radial': 'radial-gradient(circle, #1A3D64 0%, #0C2B4E 100%)',
            },
            boxShadow: {
                'horizon': '0 10px 40px -10px rgba(12, 43, 78, 0.3)',
                'horizon-lg': '0 20px 60px -15px rgba(12, 43, 78, 0.4)',
                'glow': '0 0 20px rgba(26, 61, 100, 0.5)',
                'navy': '0 4px 20px rgba(12, 43, 78, 0.2)',
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-in-out',
                'slide-up': 'slideUp 0.5s ease-out',
                'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { transform: 'translateY(20px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
            },
        },
    },

    plugins: [forms],
};
