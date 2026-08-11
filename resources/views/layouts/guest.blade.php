<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'È VOLE') }}</title>

        <!-- Fonts & Icons -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Inter:wght@300..700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

        <!-- Tailwind CDN -->
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <link rel="stylesheet" href="/css/theme.css">
        <script src="/js/theme.js"></script>
        <script src="/js/tailwind-config.js"></script>

        <style>
            html { color-scheme: light; }
            body {
                background-color: theme('colors.background');
                color: theme('colors.on-background');
            }
            .glass-panel {
                background: rgba(251, 249, 248, 0.7);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(48, 48, 49, 0.05);
                box-shadow: 0 20px 40px -10px rgba(0,0,0,0.05);
            }
            .diffused-shadow {
                box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.05);
            }
        </style>
    </head>
    <body class="font-body-md text-body-md antialiased overflow-x-hidden min-h-screen relative flex items-center justify-center">
        <!-- Ambient Decorative Background -->
        <div class="fixed top-0 left-0 w-full h-full -z-10 overflow-hidden pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full bg-secondary-container/20 blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-primary-fixed-dim/20 blur-[120px]"></div>
        </div>

        <div class="w-full max-w-5xl mx-auto px-6 py-12 flex flex-col items-center">
            <div class="mb-12 text-center relative z-10">
                <a href="/" class="inline-block">
                    <h1 class="font-display-md text-display-md text-primary tracking-tighter">È VOLE</h1>
                </a>
                <p class="font-body-lg text-body-lg text-on-surface-variant mt-3 font-light tracking-wide">
                    The Creative Engine
                </p>
            </div>

            <div class="w-full sm:max-w-md glass-panel rounded-2xl overflow-hidden p-8 sm:p-10 relative z-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

