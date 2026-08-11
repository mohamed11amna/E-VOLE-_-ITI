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
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/>
        <link rel="stylesheet" href="/css/theme.css">
        <script src="/js/theme.js"></script>
        <script src="/js/tailwind-config.js"></script>

        <style>
            html {
                color-scheme: light;
            }
            body {
                background-color: theme('colors.background');
                color: theme('colors.on-background');
            }

            .glass-panel {
                background: rgba(245, 243, 243, 0.4);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(48, 48, 49, 0.05);
                box-shadow: 0 10px 40px -10px rgba(0,0,0,0.03);
            }
            
            .campaign-card {
                transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            }
            
            .campaign-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 20px 40px -10px rgba(0,0,0,0.08);
            }
            
            .chip {
                padding: 4px 12px;
                border-radius: 9999px;
                display: inline-flex;
                align-items: center;
                gap: 4px;
            }
            
            .chip-completed {
                background-color: theme('colors.surface-container-highest');
                color: theme('colors.on-surface');
            }
            
            .chip-processing {
                background-color: theme('colors.secondary-container');
                color: theme('colors.on-secondary-container');
            }
            
            .chip-draft {
                background-color: theme('colors.surface-variant');
                color: theme('colors.on-surface-variant');
            }
        </style>
    </head>
    <body class="antialiased min-h-screen flex flex-col relative overflow-x-hidden selection:bg-secondary-fixed selection:text-on-secondary-fixed">
        
        <!-- Decorative Background Elements -->
        <div class="fixed inset-0 pointer-events-none z-[-1] overflow-hidden">
            <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full bg-secondary-fixed-dim/20 blur-[120px]"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[60%] h-[60%] rounded-full bg-surface-container-high/40 blur-[100px]"></div>
        </div>

        <!-- TopNavBar -->
        <nav class="fixed top-container-padding left-1/2 -translate-x-1/2 w-[95%] md:w-fit max-w-6xl rounded-full px-8 md:px-12 py-2 bg-surface-container-low/80 backdrop-blur-xl border border-inverse-surface/5 shadow-sm z-50 flex justify-between items-center md:gap-8 h-16 transition-all">
            <!-- Brand -->
            <a href="/" class="font-display-md text-[24px] text-primary tracking-tighter shrink-0 flex items-center h-full pt-1">
                È VOLE
            </a>
            
            <!-- Navigation Links -->
            <div id="tour-nav-links" class="hidden md:flex items-center gap-6 h-full">
                <a class="{{ request()->routeIs('campaigns.index') || request()->routeIs('campaigns.show') ? 'text-primary font-semibold border-b border-primary' : 'text-on-surface-variant hover:text-secondary border-b border-transparent' }} font-body-md text-body-md whitespace-nowrap transition-colors duration-300 h-full flex items-center px-2" href="{{ route('campaigns.index') }}">Dashboard</a>
                <a class="{{ request()->routeIs('campaigns.create') ? 'text-primary font-semibold border-b border-primary' : 'text-on-surface-variant hover:text-secondary border-b border-transparent' }} font-body-md text-body-md whitespace-nowrap transition-colors duration-300 h-full flex items-center px-2" href="{{ route('campaigns.create') }}">Creator</a>
                <a class="{{ request()->routeIs('library') ? 'text-primary font-semibold border-b border-primary' : 'text-on-surface-variant hover:text-secondary border-b border-transparent' }} font-body-md text-body-md whitespace-nowrap transition-colors duration-300 h-full flex items-center px-2" href="{{ route('library') }}">Library</a>
                @if(auth()->check() && auth()->user()->is_admin)
                    <a class="{{ request()->routeIs('admin.*') ? 'text-primary font-semibold border-b border-primary' : 'text-on-surface-variant hover:text-secondary border-b border-transparent' }} font-body-md text-body-md whitespace-nowrap transition-colors duration-300 h-full flex items-center px-2" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                @endif
            </div>

            <!-- Trailing Action -->
            <div class="hidden md:flex items-center gap-4 h-full shrink-0">
                <a href="{{ route('campaigns.create') }}" id="tour-new-campaign" class="shrink-0 items-center justify-center px-6 py-2.5 rounded-full bg-primary text-on-primary font-body-md text-body-md whitespace-nowrap hover:bg-secondary transition-colors duration-300">
                    New Campaign
                </a>
                
                @auth
                <!-- Profile Avatar -->
                <div x-data="{ open: false }" class="relative flex items-center h-full">
                    <button id="tour-profile-menu" @click="open = !open" @click.away="open = false" class="w-10 h-10 rounded-full overflow-hidden border-2 border-outline/20 hover:border-primary transition-colors focus:outline-none bg-surface-container shrink-0">
                        @if(auth()->user()->avatar)
                            <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-primary font-display-md text-sm pt-1">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        @endif
                    </button>
                    <!-- Dropdown -->
                    <div x-show="open" style="display: none;" class="absolute right-0 top-14 w-48 bg-surface border border-outline/10 rounded-xl shadow-[0_8px_32px_rgba(0,0,0,0.08)] py-2 z-50 overflow-hidden">
                        <div class="px-4 py-3 border-b border-outline/5 mb-1 bg-surface-container-low">
                            <p class="text-sm text-primary font-title-lg truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-on-surface-variant truncate mt-0.5">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-on-surface hover:bg-surface-container transition-colors">
                            <span class="material-symbols-outlined text-[18px]">person</span>
                            Profile Settings
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-1 border-t border-outline/5 pt-1">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-error hover:bg-error/5 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">logout</span>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
            
            <!-- Mobile Menu Trigger -->
            <button class="md:hidden flex items-center justify-center text-primary h-full">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">menu</span>
            </button>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow pt-[160px] pb-section-gap px-container-padding max-w-7xl mx-auto w-full flex flex-col gap-section-gap">
            {{ $slot }}
        </main>
        
        <!-- Floating Chatbot Button -->
        <a href="{{ route('chatbot.index') }}" id="tour-chatbot" class="fixed bottom-8 right-8 w-16 h-16 bg-primary text-on-primary rounded-full shadow-2xl flex items-center justify-center hover:bg-secondary hover:scale-105 transition-all duration-300 z-50">
            <span class="material-symbols-outlined text-[32px]">smart_toy</span>
        </a>

        @auth
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (!localStorage.getItem('has_seen_onboarding_tour')) {
                    const driver = window.driver.js.driver;
                    const driverObj = driver({
                        showProgress: true,
                        allowClose: false,
                        overlayOpacity: 0.65,
                        steps: [
                            {
                                element: '#tour-nav-links',
                                popover: {
                                    title: 'Navigation Menu',
                                    description: 'Use these links to move between your Dashboard, Creator studio, and Campaign Library.',
                                    side: 'bottom',
                                    align: 'start'
                                }
                            },
                            {
                                element: '#tour-new-campaign',
                                popover: {
                                    title: 'Start Generating',
                                    description: 'Click here whenever you are ready to craft a new AI-generated marketing campaign.',
                                    side: 'bottom',
                                    align: 'end'
                                }
                            },
                            {
                                element: '#tour-chatbot',
                                popover: {
                                    title: 'AI Creative Assistant',
                                    description: 'Need inspiration? Click here to chat with the AI assistant to brainstorm ideas before generating.',
                                    side: 'left',
                                    align: 'end'
                                }
                            },
                            {
                                element: '#tour-profile-menu',
                                popover: {
                                    title: 'Your Account',
                                    description: 'Access your profile settings, analytics, and log out from this menu. Enjoy È VOLE!',
                                    side: 'bottom',
                                    align: 'end'
                                }
                            }
                        ],
                        onDestroyed: () => {
                            localStorage.setItem('has_seen_onboarding_tour', 'true');
                        }
                    });

                    // Small delay to ensure rendering is complete before starting tour
                    setTimeout(() => {
                        driverObj.drive();
                    }, 500);
                }
            });
        </script>
        @endauth
    </body>
</html>

