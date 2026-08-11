<?php $user = auth()->user(); ?>
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Profile Settings - È VOLE</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }
        .silk-gradient {
            background: radial-gradient(circle at top right, rgba(255,218,212,0.15), transparent 40%),
                        radial-gradient(circle at bottom left, rgba(228,226,226,0.5), transparent 60%);
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(28, 27, 27, 0.05);
        }
    </style>
<link rel="stylesheet" href="/css/theme.css">
        <script src="/js/theme.js"></script>
        <script src="/js/tailwind-config.js"></script>
</head>
<body class="bg-background text-on-background font-body-lg min-h-screen silk-gradient antialiased selection:bg-secondary-fixed selection:text-on-secondary-fixed overflow-x-hidden flex flex-col md:flex-row">
<!-- SideNavBar -->
<nav class="hidden md:flex h-screen w-72 flex-col bg-surface dark:bg-surface-dim bg-surface-container-low dark:bg-surface-container-lowest flat no shadows fixed left-0 top-0 z-40 p-6">
<div class="mb-12">
<h1 class="font-display-md text-display-md text-primary">È VOLE</h1>
<p class="font-body-md text-body-md text-on-surface-variant mt-2">Premium Tier</p>
</div>
<ul class="flex flex-col gap-2 flex-grow">
<li>
<a class="flex items-center gap-4 text-on-surface-variant dark:text-outline-variant px-4 py-3 hover:bg-surface-container hover:bg-surface-container-high transition-colors duration-300 rounded-lg font-body-md text-body-md" href="{{ route('profile.edit') }}">
<span class="material-symbols-outlined">dashboard</span>
                    Overview
                </a>
</li>
<li>
<a class="flex items-center gap-4 text-on-surface-variant dark:text-outline-variant px-4 py-3 hover:bg-surface-container hover:bg-surface-container-high transition-colors duration-300 rounded-lg font-body-md text-body-md" href="{{ route('library') }}">
<span class="material-symbols-outlined">auto_awesome_motion</span>
                    Library
                </a>
</li>
<li>
<a class="flex items-center gap-4 text-primary dark:text-secondary-fixed bg-secondary-fixed/10 rounded-lg px-4 py-3 hover:bg-surface-container-high transition-colors duration-300 font-body-md text-body-md Active: translate-x-1 transition-transform" href="{{ route('profile.analytics') }}">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">analytics</span>
                    Analytics
                </a>
</li>
<li>
<a class="flex items-center gap-4 text-on-surface-variant dark:text-outline-variant px-4 py-3 hover:bg-surface-container hover:bg-surface-container-high transition-colors duration-300 rounded-lg font-body-md text-body-md" href="{{ route('profile.edit') }}">
<span class="material-symbols-outlined">settings</span>
                    Settings
                </a>
</li>
</ul>
<div class="mt-auto">
<button class="w-full py-3 px-4 bg-primary text-on-primary rounded-full font-label-caps text-label-caps hover:bg-secondary transition-colors mb-6 shadow-[0_4px_24px_rgba(28,27,27,0.1)]">
                Upgrade to Elite
            </button>
<a class="flex items-center gap-4 text-on-surface-variant dark:text-outline-variant px-4 py-3 hover:bg-surface-container hover:bg-surface-container-high transition-colors duration-300 rounded-lg font-body-md text-body-md" href="#">
<span class="material-symbols-outlined">help_outline</span>
                Support
            </a>
</div>
</nav>
<!-- Main Content -->
<main class="w-full md:ml-72 min-h-screen px-container-padding py-section-gap">
<div class="max-w-6xl mx-auto">
<header class="mb-20">
<h2 class="font-display-lg text-display-lg text-primary mb-4">Settings &amp; Profile</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Curate your digital presence. Refine your aesthetic identity and manage your atelier's core configurations.</p>
</header>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24 relative">
<!-- Fluid Line Decoration -->
<div class="hidden lg:block absolute left-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-outline-variant/30 to-transparent -translate-x-1/2"></div>
<!-- Left Column: Profile & Presence -->
<div class="lg:col-span-12 w-full max-w-4xl mx-auto">
<header class="mb-16">
<h2 class="font-display-lg text-display-lg tracking-tight text-primary mb-4">Analytics Dashboard</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Monitor your creative output and resource usage across È VOLE.</p>
</header>
<!-- Analytics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
    <div class="glass-panel rounded-xl p-8 shadow-[0_12px_48px_-12px_rgba(28,27,27,0.05)] flex flex-col justify-center items-center text-center">
        <span class="material-symbols-outlined text-[48px] text-secondary mb-4">token</span>
        <h3 class="font-headline-md text-headline-md text-on-surface-variant mb-2">Tokens Used</h3>
        <p class="font-display-lg text-[64px] text-primary">{{ number_format($tokensUsed) }}</p>
    </div>
    <div class="glass-panel rounded-xl p-8 shadow-[0_12px_48px_-12px_rgba(28,27,27,0.05)] flex flex-col justify-center items-center text-center">
        <span class="material-symbols-outlined text-[48px] text-secondary mb-4">image</span>
        <h3 class="font-headline-md text-headline-md text-on-surface-variant mb-2">Images Generated</h3>
        <p class="font-display-lg text-[64px] text-primary">{{ number_format($imagesGenerated) }}</p>
    </div>
</div>
</div>
</div>
</div>
<!-- Footer -->
<footer class="mt-32 max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center w-full py-section-gap border-t border-outline/10 font-label-caps text-label-caps text-primary dark:text-on-surface transition-colors">
<div class="font-display-lg text-display-lg mb-6 md:mb-0">È VOLE</div>
<p class="mb-6 md:mb-0 text-on-surface-variant dark:text-outline-variant hover:text-secondary">© 2024 È VOLE. Fluid Elegance in Motion.</p>
<div class="flex gap-6">
<a class="text-on-surface-variant dark:text-outline-variant hover:text-secondary transition-colors" href="#">Privacy</a>
<a class="text-on-surface-variant dark:text-outline-variant hover:text-secondary transition-colors" href="#">Terms</a>
<a class="text-on-surface-variant dark:text-outline-variant hover:text-secondary transition-colors" href="#">Editorial</a>
</div>
</footer>
</main>
<!-- Delete Modal -->
<div class="hidden fixed inset-0 z-50 flex items-center justify-center p-4" id="delete-modal">
<div class="absolute inset-0 bg-surface-container-lowest/80 backdrop-blur-md" onclick="document.getElementById('delete-modal').classList.add('hidden')"></div>
<div class="bg-surface rounded-2xl shadow-[0_24px_96px_rgba(186,26,26,0.15)] border border-error/10 p-8 max-w-md w-full relative z-10">
<form method="post" action="{{ route('profile.destroy') }}">
@csrf
@method('delete')
<h3 class="font-headline-lg text-headline-lg text-primary mb-4">Confirm Deletion</h3>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-6">This action cannot be undone. All your campaigns, assets, and settings will be permanently erased. Enter your password to confirm.</p>
<div class="relative mb-8">
<input  class="peer w-full bg-surface-container-lowest rounded-lg border-none px-4 py-4 font-body-lg text-body-lg text-primary placeholder-transparent focus:ring-0 shadow-sm transition-all focus:shadow-[0_0_0_1px_#ba1a1a]"  id="password" name="password"  placeholder="Password" type="password" />
<x-input-error class="mt-2 text-error text-xs absolute -bottom-5" :messages="$errors->userDeletion->get('password')" />
<label class="absolute left-4 -top-2.5 bg-surface-container-lowest px-1 font-label-caps text-label-caps text-on-surface-variant transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-body-lg peer-placeholder-shown:font-body-lg peer-focus:-top-2.5 peer-focus:text-label-caps peer-focus:font-label-caps peer-focus:text-error" for="confirm-delete-pwd">Password</label>
</div>
<div class="flex gap-4 justify-end">
<button type="button" class="px-6 py-3 rounded-full font-label-caps text-label-caps text-primary hover:bg-surface-container transition-colors uppercase" onclick="document.getElementById('delete-modal').classList.add('hidden')">
                    Cancel
                </button>
<button type="submit" class="bg-error text-on-error px-6 py-3 rounded-full font-label-caps text-label-caps hover:bg-[#93000a] transition-colors uppercase shadow-sm">
                    Permanently Delete
                </button>
</form>
</div>
</div>
</div>
</body></html>
