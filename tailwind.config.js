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
                sans: ['"DM Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                display: ['"Space Grotesk"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
            colors: {
                background: 'oklch(var(--background) / <alpha-value>)',
                foreground: 'oklch(var(--foreground) / <alpha-value>)',
                surface: 'oklch(var(--surface) / <alpha-value>)',
                'surface-raised': 'oklch(var(--surface-raised) / <alpha-value>)',
                card: 'oklch(var(--card) / <alpha-value>)',
                'card-foreground': 'oklch(var(--card-foreground) / <alpha-value>)',
                popover: 'oklch(var(--popover) / <alpha-value>)',
                'popover-foreground': 'oklch(var(--popover-foreground) / <alpha-value>)',
                primary: 'oklch(var(--primary) / <alpha-value>)',
                'primary-foreground': 'oklch(var(--primary-foreground) / <alpha-value>)',
                secondary: 'oklch(var(--secondary) / <alpha-value>)',
                'secondary-foreground': 'oklch(var(--secondary-foreground) / <alpha-value>)',
                muted: 'oklch(var(--muted) / <alpha-value>)',
                'muted-foreground': 'oklch(var(--muted-foreground) / <alpha-value>)',
                accent: 'oklch(var(--accent) / <alpha-value>)',
                'accent-foreground': 'oklch(var(--accent-foreground) / <alpha-value>)',
                destructive: 'oklch(var(--destructive) / <alpha-value>)',
                'destructive-foreground': 'oklch(var(--destructive-foreground) / <alpha-value>)',
                success: 'oklch(var(--success) / <alpha-value>)',
                warning: 'oklch(var(--warning) / <alpha-value>)',
                info: 'oklch(var(--info) / <alpha-value>)',
                border: 'oklch(var(--border) / <alpha-value>)',
                'border-strong': 'oklch(var(--border-strong) / <alpha-value>)',
                input: 'oklch(var(--input) / <alpha-value>)',
                ring: 'oklch(var(--ring) / <alpha-value>)',
            },
        },
    },

    plugins: [forms],
};
