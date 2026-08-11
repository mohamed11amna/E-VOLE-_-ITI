<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Workspace - {{ config('app.name', 'È VOLE') }}</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="/css/theme.css">
    <script src="/js/theme.js"></script>
    <script src="/js/tailwind-config.js"></script>

    <style>
        body {
            background-color: var(--color-background);
            color: var(--color-on-background);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined.fill {
            font-variation-settings: 'FILL' 1;
        }
        .diffused-shadow {
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.05);
        }
        .glass-layer {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0,0,0,0.02);
        }
    </style>
</head>
<body class="flex min-h-screen bg-background text-on-background antialiased selection:bg-secondary-container selection:text-on-secondary-container">

    <!-- Top Navigation (Desktop Floating Island) -->
    <nav class="fixed top-4 left-1/2 -translate-x-1/2 w-[95%] md:w-fit rounded-full bg-surface/80 dark:bg-inverse-surface/80 backdrop-blur-xl border border-primary/5 dark:border-on-primary/5 shadow-sm flex justify-between items-center px-8 md:px-12 md:gap-8 h-14 max-w-7xl mx-auto z-50 hidden md:flex">
        <a href="/" class="font-headline-lg text-headline-lg tracking-tighter text-primary dark:text-on-primary hover:opacity-80 transition-opacity shrink-0">
            È VOLE
        </a>
        <div class="flex items-center gap-6 font-body-md text-body-md">
            <a class="text-primary dark:text-on-primary active:scale-95 transition-transform whitespace-nowrap" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            <a class="text-on-surface-variant dark:text-surface-variant hover:text-secondary dark:hover:text-secondary-container transition-colors duration-300 active:scale-95 transition-transform whitespace-nowrap" href="{{ route('campaigns.index') }}">Campaigns</a>
            <a class="text-on-surface-variant dark:text-surface-variant hover:text-secondary dark:hover:text-secondary-container transition-colors duration-300 active:scale-95 transition-transform whitespace-nowrap" href="#">Analytics</a>
            <a class="text-on-surface-variant dark:text-surface-variant hover:text-secondary dark:hover:text-secondary-container transition-colors duration-300 active:scale-95 transition-transform whitespace-nowrap" href="#">System</a>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('campaigns.index') }}" class="bg-primary text-on-primary px-6 py-2 rounded-full font-label-caps text-label-caps hover:bg-secondary transition-colors whitespace-nowrap">Back to App</a>
        </div>
    </nav>

    <!-- Side Navigation (Admin Shell) -->
    <aside class="bg-surface-container-low dark:bg-inverse-surface h-[calc(100vh-7rem)] w-72 mt-24 ml-4 mb-4 rounded-lg bg-gradient-to-b from-surface-container-lowest to-surface-container shadow-xl shadow-secondary/5 flex flex-col p-6 space-y-4 z-40 hidden md:flex sticky top-24 overflow-y-auto shrink-0 custom-scrollbar">
        <div class="flex flex-col items-center mb-8 pt-4">
            @if(auth()->user()->avatar)
                <img class="w-20 h-20 rounded-full object-cover mb-4 shadow-sm" src="{{ Storage::url(auth()->user()->avatar) }}"/>
            @else
                <div class="w-20 h-20 rounded-full bg-surface-container border-2 border-outline/20 flex items-center justify-center text-primary font-display-md mb-4 shadow-sm">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            @endif
            <h2 class="font-headline-lg text-[24px] text-primary dark:text-on-primary text-center truncate w-full">{{ auth()->user()->name }}</h2>
            <p class="font-label-caps text-label-caps text-secondary mt-1">System Admin</p>
        </div>
        
        <nav class="flex-1 space-y-2">
            <a class="{{ request()->routeIs('admin.dashboard') ? 'bg-secondary-container dark:bg-secondary text-on-secondary-container dark:text-on-secondary' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-variant/50 dark:hover:bg-surface-variant/20' }} rounded-xl flex items-center gap-4 px-4 py-3 transition-all duration-500 ease-out" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.dashboard') ? 'fill' : '' }} text-[24px] shrink-0">dashboard</span>
                <span class="font-label-caps text-label-caps whitespace-nowrap">Platform Overview</span>
            </a>
            <a class="{{ request()->routeIs('admin.users.*') ? 'bg-secondary-container dark:bg-secondary text-on-secondary-container dark:text-on-secondary' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-variant/50 dark:hover:bg-surface-variant/20' }} rounded-xl flex items-center gap-4 px-4 py-3 transition-all duration-500 ease-out" href="{{ route('admin.users.index') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.users.*') ? 'fill' : '' }} text-[24px] shrink-0">group</span>
                <span class="font-label-caps text-label-caps whitespace-nowrap">Users</span>
            </a>
            <a class="text-on-surface-variant dark:text-surface-variant hover:bg-surface-variant/50 dark:hover:bg-surface-variant/20 rounded-xl flex items-center gap-4 px-4 py-3 transition-all duration-500 ease-out" href="#">
                <span class="material-symbols-outlined text-[24px] shrink-0">api</span>
                <span class="font-label-caps text-label-caps whitespace-nowrap">API Status</span>
            </a>
            <a class="text-on-surface-variant dark:text-surface-variant hover:bg-surface-variant/50 dark:hover:bg-surface-variant/20 rounded-xl flex items-center gap-4 px-4 py-3 transition-all duration-500 ease-out" href="#">
                <span class="material-symbols-outlined text-[24px] shrink-0">cloud_done</span>
                <span class="font-label-caps text-label-caps whitespace-nowrap">Cloud Health</span>
            </a>
            <a class="text-on-surface-variant dark:text-surface-variant hover:bg-surface-variant/50 dark:hover:bg-surface-variant/20 rounded-xl flex items-center gap-4 px-4 py-3 transition-all duration-500 ease-out" href="#">
                <span class="material-symbols-outlined text-[24px] shrink-0">payments</span>
                <span class="font-label-caps text-label-caps whitespace-nowrap">Billing</span>
            </a>
            <a class="text-on-surface-variant dark:text-surface-variant hover:bg-surface-variant/50 dark:hover:bg-surface-variant/20 rounded-xl flex items-center gap-4 px-4 py-3 transition-all duration-500 ease-out" href="#">
                <span class="material-symbols-outlined text-[24px] shrink-0">receipt_long</span>
                <span class="font-label-caps text-label-caps whitespace-nowrap">Logs</span>
            </a>
        </nav>
        
        <div class="mt-auto space-y-2">
            <a class="text-on-surface-variant dark:text-surface-variant hover:bg-surface-variant/50 dark:hover:bg-surface-variant/20 rounded-xl flex items-center gap-4 px-4 py-3 transition-all duration-500 ease-out" href="#">
                <span class="material-symbols-outlined text-[24px] shrink-0">help</span>
                <span class="font-label-caps text-label-caps whitespace-nowrap">Support</span>
            </a>
            <a class="text-on-surface-variant dark:text-surface-variant hover:bg-surface-variant/50 dark:hover:bg-surface-variant/20 rounded-xl flex items-center gap-4 px-4 py-3 transition-all duration-500 ease-out" href="#">
                <span class="material-symbols-outlined text-[24px] shrink-0">description</span>
                <span class="font-label-caps text-label-caps whitespace-nowrap">Documentation</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full bg-surface-variant text-on-surface-variant py-3 rounded-full font-label-caps text-label-caps hover:bg-error hover:text-on-error transition-colors mb-4 mt-2">Log Out</button>
            </form>
        </div>
    </aside>

    <!-- Main Content Canvas -->
    <main class="flex-1 w-full p-container-padding md:pt-32 pt-8 pb-32 space-y-section-gap overflow-x-hidden">
        {{ $slot }}
    </main>

    <!-- Floating Chatbot Button -->
    <a href="{{ route('chatbot.index') }}" class="fixed bottom-8 right-8 w-16 h-16 bg-primary text-on-primary rounded-full shadow-2xl flex items-center justify-center hover:bg-secondary hover:scale-105 transition-all duration-300 z-50">
        <span class="material-symbols-outlined text-[32px]">smart_toy</span>
    </a>

</body>
</html>

