<!DOCTYPE html>

<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>È VOLE - Fluid Elegance</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&amp;family=Inter:wght@100..900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="/css/theme.css">
        <script src="/js/theme.js"></script>
        <script src="/js/tailwind-config.js"></script>
<style>
        .material-symbols-outlined {
          font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }
        body {
            background-color: theme('colors.background');
            color: theme('colors.on-background');
        }
      </style>
</head>
<body class="antialiased min-h-screen selection:bg-secondary-container selection:text-on-secondary-container overflow-x-hidden">
<!-- TopNavBar -->
<nav class="fixed top-4 left-1/2 -translate-x-1/2 w-[90%] rounded-full bg-surface/80 backdrop-blur-xl dark:bg-surface/80 text-primary dark:text-on-primary-fixed border border-on-surface/5 shadow-sm flex justify-between items-center px-8 py-3 max-w-7xl mx-auto z-50 transition-all duration-500 hover:shadow-md">
<a class="font-display-md text-display-md font-semibold text-primary dark:text-on-primary-fixed tracking-tight" href="#">È VOLE</a>
<div class="hidden md:flex items-center gap-12 font-body-lg text-body-lg tracking-wide">
<a class="text-on-surface-variant hover:text-secondary transition-colors duration-300" href="{{ route('campaigns.create') }}">Creator</a>
<a class="text-on-surface-variant hover:text-secondary transition-colors duration-300" href="{{ route('library') }}">Library</a>
</div>
        @if (Route::has('login'))
    @auth
        <a class="font-body-lg text-body-lg tracking-wide text-primary dark:text-on-primary-fixed hover:text-secondary transition-colors duration-300 active:scale-95 transition-transform flex items-center gap-2 border border-on-surface/5 px-6 py-2 rounded-full hover:bg-surface-container-low" href="{{ url('/dashboard') }}">
            Dashboard
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
    @else
        <div class="flex items-center gap-4">
            <a class="font-body-lg text-body-lg tracking-wide text-primary dark:text-on-primary-fixed hover:text-secondary transition-colors duration-300 px-4 py-2 rounded-full hover:bg-surface-container-low" href="{{ route('login') }}">
                Log In
            </a>
            @if (Route::has('register'))
                <a class="font-body-lg text-body-lg tracking-wide text-on-tertiary bg-tertiary hover:bg-secondary transition-colors duration-300 active:scale-95 transition-transform flex items-center gap-2 px-6 py-2 rounded-full shadow-sm" href="{{ route('register') }}">
                    Sign Up
                </a>
            @endif
        </div>
    @endauth
@endif
</nav>
<!-- Hero Section -->
<header class="relative min-h-[921px] flex items-center justify-center pt-32 pb-20 px-container-padding">
<!-- Ethereal Background -->
<div class="absolute inset-0 z-0 overflow-hidden">
<div class="absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat opacity-60 scale-105 transform origin-top transition-transform duration-1000 ease-out" data-alt="A breathtaking, ethereal high-fashion editorial shot featuring a model draped in translucent, generative silk that seems to dissolve into digital light. The setting is a minimalist, vast white studio with soft, diffused high-key lighting that emphasizes a light-mode aesthetic. The color palette focuses on pristine whites, soft champagne, and deep charcoal shadows, creating a mood of futuristic luxury and effortless grace." style="background-image: url('/images/welcome_page_background.png')"></div>
<!-- Glassmorphic gradient overlay -->
<div class="absolute inset-0 bg-gradient-to-b from-surface/20 via-surface/60 to-background backdrop-blur-[2px]"></div>
</div>
<div class="relative z-10 text-center max-w-5xl mx-auto flex flex-col items-center">
<h1 class="font-display-lg text-display-lg text-primary mb-8 tracking-tight drop-shadow-sm leading-tight">
                The Future of <br/>Generated Ads
            </h1>
<p class="font-title-lg text-title-lg text-on-surface-variant max-w-2xl mb-12 opacity-90">
                Quantum creativity powers your market presence. Architect high-impact, custom-fit advertising strategies with instantaneous iteration and impeccable visual precision.
            </p>
<div class="flex flex-col sm:flex-row items-center gap-6">
<a href="{{ route('register') }}" class="bg-tertiary text-on-tertiary px-8 py-4 rounded-full font-body-lg text-body-lg hover:bg-secondary transition-colors duration-300 shadow-lg shadow-tertiary/10 flex items-center gap-3 group inline-flex">
                    Get Started
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">east</span>
</a>
</div>
</div>
</header>
<!-- Features Section: Organic Layout -->
<main class="relative z-10 bg-background">
<!-- Neural Synthesis -->
<section class="py-section-gap px-container-padding max-w-7xl mx-auto">
<div class="flex flex-col md:flex-row items-center gap-16 md:gap-24">
<div class="w-full md:w-1/2 order-2 md:order-1 flex justify-center">
<div class="relative w-full max-w-md aspect-[4/5] rounded-xl overflow-hidden shadow-[0_20px_60px_-15px_rgba(0,0,0,0.05)] transform -rotate-1 hover:rotate-0 transition-transform duration-700">
<img class="w-full h-full object-cover" data-alt="A macro photography shot of an impossibly delicate, AI-generated digital fabric, resembling liquid silk interwoven with fine geometric metallic threads. The lighting is soft and directional, highlighting the complex textures against a pale, pristine surface. The color palette is strictly high-fashion minimalist: warm whites, muted champagne, and deep charcoal accents, evoking a sense of calm, exclusivity, and technological mastery." src="/images/intelligent_ad_generation.png"/>
</div>
</div>
<div class="w-full md:w-1/2 order-1 md:order-2 space-y-6">
<div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-container border border-on-surface/5 font-label-caps text-label-caps text-secondary uppercase tracking-widest">
<span class="material-symbols-outlined text-[14px]">auto_awesome</span>
                        Core Engine
                    </div>
<h2 class="font-headline-lg text-headline-lg text-primary">Intelligent Ad Generation</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                        Step beyond standard generation. Our proprietary AI is trained to craft high-converting, professional marketing campaigns that resonate with your audience. Generate compelling ad copy, optimize your visuals, and launch strategies that drive real engagement and growth.
                    </p>
</div>
</div>
</section>
<!-- Editorial Curation -->
<section class="py-section-gap px-container-padding max-w-7xl mx-auto">
<div class="flex flex-col md:flex-row items-center gap-16 md:gap-24">
<div class="w-full md:w-1/2 space-y-6 md:pl-12">
<div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-container border border-on-surface/5 font-label-caps text-label-caps text-secondary uppercase tracking-widest">
<span class="material-symbols-outlined text-[14px]">view_carousel</span>
                        Workflow
                    </div>
<h2 class="font-headline-lg text-headline-lg text-primary">Streamlined Campaign Workflow</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                        Experience a dashboard built for modern marketers. Streamline your workflow in a clean, intuitive workspace where data and creativity merge seamlessly. Manage your marketing campaigns in a distraction-free environment that prioritizes your strategic vision over technical friction.
                    </p>
</div>
<div class="w-full md:w-1/2 flex justify-center translate-y-0 md:translate-y-12">
<div class="relative w-full max-w-md aspect-[3/4] rounded-xl overflow-hidden shadow-[0_30px_70px_-20px_rgba(0,0,0,0.08)] transform rotate-2 hover:rotate-0 transition-transform duration-700">
<img class="w-full h-full object-cover" data-alt="A stylized, abstract workspace environment suggesting a high-fashion digital atelier. Floating, semi-transparent frosted glass panels overlap against a vast, soft-lit warm white background. Subtle typography and sleek UI elements are barely visible on the glass, blending software interface with editorial grace. The mood is sophisticated minimalism, utilizing deep charcoal low-opacity shadows to create a diffused, floating depth effect." src="/images/workflow.png"/>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="w-full py-20 px-container-padding border-t border-on-surface/5 text-primary dark:text-on-surface font-body-md text-body-md flex flex-col md:flex-row justify-between items-center gap-8 max-w-7xl mx-auto mt-24">
<div class="font-display-md text-display-md text-primary tracking-tight">È VOLE</div>
<div class="flex flex-wrap justify-center gap-8 text-on-tertiary-container">
<a class="hover:text-secondary transition-colors" href="#">Terms</a>
<a class="hover:text-secondary transition-colors" href="#">Privacy</a>
<a class="hover:text-secondary transition-colors" href="#">Careers</a>
<a class="hover:text-secondary transition-colors" href="#">Contact</a>
</div>
<div class="text-on-tertiary-container text-sm">
            © 2024 È VOLE. Fluid Elegance in Advertising.
        </div>
</footer>
</body></html>
