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
<a class="flex items-center gap-4 text-on-surface-variant dark:text-outline-variant px-4 py-3 hover:bg-surface-container hover:bg-surface-container-high transition-colors duration-300 rounded-lg font-body-md text-body-md" href="{{ route('profile.analytics') }}">
<span class="material-symbols-outlined">analytics</span>
                    Analytics
                </a>
</li>
<li>
<a class="flex items-center gap-4 text-primary dark:text-secondary-fixed bg-secondary-fixed/10 rounded-lg px-4 py-3 hover:bg-surface-container-high transition-colors duration-300 font-body-md text-body-md Active: translate-x-1 transition-transform" href="{{ route('profile.edit') }}">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">settings</span>
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
<div class="lg:col-span-7 space-y-24">
<!-- Profile Information -->
<section class="glass-panel rounded-xl p-8 md:p-12 shadow-[0_12px_48px_-12px_rgba(28,27,27,0.05)] relative overflow-hidden group">
<div class="absolute inset-0 bg-gradient-to-br from-surface-container-lowest/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
<div class="relative z-10">
<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
@csrf
@method('patch')
<h3 class="font-headline-lg text-headline-lg text-primary mb-12">Profile Information</h3>
<div class="flex flex-col sm:flex-row gap-8 items-start mb-12">
<div class="relative group/avatar cursor-pointer">
<div class="w-32 h-32 rounded-full overflow-hidden border border-outline/10 shadow-sm relative">
<img class="w-full h-full object-cover" src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&color=7F9CF5&background=EBF4FF' }}"/>
<div class="absolute inset-0 bg-primary/20 flex items-center justify-center opacity-0 group-hover/avatar:opacity-100 transition-opacity backdrop-blur-sm">
<span class="material-symbols-outlined text-on-primary">photo_camera</span>
</div>
<input type="file" name="avatar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
</div>
<p class="font-label-caps text-label-caps text-on-surface-variant mt-4 text-center">Up to 2MB</p>
</div>
<div class="flex-grow space-y-6 w-full">
<div class="relative">
<input class="peer w-full bg-surface-container-lowest rounded-lg border-none px-4 py-4 font-body-lg text-body-lg text-primary placeholder-transparent focus:ring-0 shadow-sm transition-all focus:shadow-[0_0_0_1px_#8c4d42]" id="name" name="name" placeholder="Name" type="text" value="{{ old('name', $user->name) }}"/>
<x-input-error class="mt-2 text-error text-xs absolute" :messages="$errors->get('name')" />
<label class="absolute left-4 -top-2.5 bg-surface-container-lowest px-1 font-label-caps text-label-caps text-on-surface-variant transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-body-lg peer-placeholder-shown:font-body-lg peer-focus:-top-2.5 peer-focus:text-label-caps peer-focus:font-label-caps peer-focus:text-secondary" for="name">Name</label>
</div>
</div>
</div>
<div class="space-y-8">
<div class="relative">
<input  class="peer w-full bg-surface-container-lowest rounded-lg border-none px-4 py-4 font-body-lg text-body-lg text-primary placeholder-transparent focus:ring-0 shadow-sm transition-all focus:shadow-[0_0_0_1px_#8c4d42]"  placeholder="Email" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" />
<x-input-error class="mt-2 text-error text-xs absolute" :messages="$errors->get('email')" />
<label class="absolute left-4 -top-2.5 bg-surface-container-lowest px-1 font-label-caps text-label-caps text-on-surface-variant transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-body-lg peer-placeholder-shown:font-body-lg peer-focus:-top-2.5 peer-focus:text-label-caps peer-focus:font-label-caps peer-focus:text-secondary" for="email">Email Address</label>
</div>
<!-- Unverified Warning -->
<div class="bg-secondary-fixed/20 border border-secondary-fixed rounded-lg p-4 flex items-center justify-between">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-secondary">warning</span>
<p class="font-body-md text-body-md text-on-secondary-container">Email unverified</p>
</div>
<button class="font-label-caps text-label-caps text-secondary hover:text-primary transition-colors uppercase underline decoration-1 underline-offset-4">Resend Link</button>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
<div class="relative">
<input class="peer w-full bg-surface-container-lowest rounded-lg border-none px-4 py-4 font-body-lg text-body-lg text-primary placeholder-transparent focus:ring-0 shadow-sm transition-all focus:shadow-[0_0_0_1px_#8c4d42]" id="job" name="job_title" placeholder="Job Title" type="text" value="{{ old('job_title', $user->job_title) }}"/>
<x-input-error class="mt-2 text-error text-xs absolute" :messages="$errors->get('job_title')" />
<label class="absolute left-4 -top-2.5 bg-surface-container-lowest px-1 font-label-caps text-label-caps text-on-surface-variant transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-body-lg peer-placeholder-shown:font-body-lg peer-focus:-top-2.5 peer-focus:text-label-caps peer-focus:font-label-caps peer-focus:text-secondary" for="job">Job Title</label>
</div>
<div class="relative">
<input  class="peer w-full bg-surface-container-lowest rounded-lg border-none px-4 py-4 font-body-lg text-body-lg text-primary placeholder-transparent focus:ring-0 shadow-sm transition-all focus:shadow-[0_0_0_1px_#8c4d42]"  placeholder="Company" type="text" id="company" name="company" value="{{ old('company', $user->company) }}" />
<x-input-error class="mt-2 text-error text-xs absolute" :messages="$errors->get('company')" />
<label class="absolute left-4 -top-2.5 bg-surface-container-lowest px-1 font-label-caps text-label-caps text-on-surface-variant transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-body-lg peer-placeholder-shown:font-body-lg peer-focus:-top-2.5 peer-focus:text-label-caps peer-focus:font-label-caps peer-focus:text-secondary" for="company">Company</label>
</div>
</div>
<div class="relative">
<textarea  class="peer w-full bg-surface-container-lowest rounded-lg border-none px-4 py-4 font-body-lg text-body-lg text-primary placeholder-transparent focus:ring-0 shadow-sm transition-all focus:shadow-[0_0_0_1px_#8c4d42] resize-none"  placeholder="Bio" rows="4" id="bio" name="bio">{{ old('bio', $user->bio) }}</textarea>
<x-input-error class="mt-2 text-error text-xs absolute -bottom-5" :messages="$errors->get('bio')" />
<label class="absolute left-4 -top-2.5 bg-surface-container-lowest px-1 font-label-caps text-label-caps text-on-surface-variant transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-body-lg peer-placeholder-shown:font-body-lg peer-focus:-top-2.5 peer-focus:text-label-caps peer-focus:font-label-caps peer-focus:text-secondary" for="bio">Bio</label>
</div>
</div>
</div>
</section>
<!-- Professional Presence -->
<section class="glass-panel rounded-xl p-8 md:p-12 shadow-[0_12px_48px_-12px_rgba(28,27,27,0.05)] relative overflow-hidden group">
<div class="absolute inset-0 bg-gradient-to-tl from-surface-container-lowest/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
<div class="relative z-10">
<h3 class="font-headline-lg text-headline-lg text-primary mb-12">Professional Presence</h3>
<div class="space-y-8">
<div class="relative">
<input  class="w-full bg-transparent border-x-0 border-t-0 border-b-[0.5px] border-outline/30 px-0 py-4 font-body-lg text-body-lg text-primary focus:ring-0 focus:border-secondary transition-colors"  placeholder="Expertise" type="text" id="expertise" name="expertise" value="{{ old('expertise', $user->expertise) }}" />
<x-input-error class="mt-2 text-error text-xs absolute" :messages="$errors->get('expertise')" />
<label class="absolute left-0 -top-2 font-label-caps text-label-caps text-on-surface-variant" for="expertise">Expertise</label>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
<div class="relative">
<input  class="w-full bg-transparent border-x-0 border-t-0 border-b-[0.5px] border-outline/30 px-0 py-4 font-body-lg text-body-lg text-primary focus:ring-0 focus:border-secondary transition-colors"  placeholder="Portfolio/Website" type="url" id="website_link" name="website_link" value="{{ old('website_link', $user->website_link) }}" />
<x-input-error class="mt-2 text-error text-xs absolute" :messages="$errors->get('website_link')" />
<label class="absolute left-0 -top-2 font-label-caps text-label-caps text-on-surface-variant" for="portfolio">Portfolio / Website</label>
</div>
<div class="relative">
<input  class="w-full bg-transparent border-x-0 border-t-0 border-b-[0.5px] border-outline/30 px-0 py-4 font-body-lg text-body-lg text-primary focus:ring-0 focus:border-secondary transition-colors"  placeholder="LinkedIn" type="text" id="linkedin_profile" name="linkedin_profile" value="{{ old('linkedin_profile', $user->linkedin_profile) }}" />
<x-input-error class="mt-2 text-error text-xs absolute" :messages="$errors->get('linkedin_profile')" />
<label class="absolute left-0 -top-2 font-label-caps text-label-caps text-on-surface-variant" for="linkedin">LinkedIn</label>
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
<div class="relative">
<input  class="w-full bg-transparent border-x-0 border-t-0 border-b-[0.5px] border-outline/30 px-0 py-4 font-body-lg text-body-lg text-primary focus:ring-0 focus:border-secondary transition-colors"  placeholder="Twitter" type="text" id="twitter_profile" name="twitter_profile" value="{{ old('twitter_profile', $user->twitter_profile) }}" />
<x-input-error class="mt-2 text-error text-xs absolute" :messages="$errors->get('twitter_profile')" />
<label class="absolute left-0 -top-2 font-label-caps text-label-caps text-on-surface-variant" for="twitter">Twitter / X</label>
</div>
<div class="relative">
<input  class="w-full bg-transparent border-x-0 border-t-0 border-b-[0.5px] border-outline/30 px-0 py-4 font-body-lg text-body-lg text-on-surface-variant focus:ring-0 cursor-not-allowed opacity-60"  readonly="" type="text" id="affiliate_partner" name="affiliate_partner" value="{{ old('affiliate_partner', $user->affiliate_partner) }}" />
<x-input-error class="mt-2 text-error text-xs absolute" :messages="$errors->get('affiliate_partner')" />
<label class="absolute left-0 -top-2 font-label-caps text-label-caps text-on-surface-variant opacity-60" for="affiliate">Affiliate Code (Read-only)</label>
</div>
</div>
</div>
</div>
</section>
<div class="flex justify-end pt-8 border-t border-outline/10">
<button type="submit" class="bg-primary text-on-primary rounded-full px-8 py-4 font-label-caps text-label-caps hover:bg-secondary transition-all shadow-[0_4px_24px_rgba(28,27,27,0.15)] hover:shadow-[0_8px_32px_rgba(140,77,66,0.3)] hover:-translate-y-0.5 uppercase tracking-wider">
                            Save Profile
                        </button>
</div>
</form>
<!-- Right Column: Security & Danger -->
<div class="lg:col-span-5 space-y-12">
<!-- Update Password -->
<section class="glass-panel rounded-xl p-8 shadow-[0_12px_48px_-12px_rgba(28,27,27,0.05)]">
<form method="post" action="{{ route('password.update') }}">
@csrf
@method('put')
<h3 class="font-title-lg text-title-lg text-primary mb-8 flex items-center gap-3">
<span class="material-symbols-outlined text-secondary">lock</span>
                            Security
                        </h3>
<div class="space-y-6">
<div class="relative">
<input  class="peer w-full bg-surface-container-lowest rounded-lg border-none px-4 py-4 font-body-lg text-body-lg text-primary placeholder-transparent focus:ring-0 shadow-sm transition-all focus:shadow-[0_0_0_1px_#8c4d42]"  id="current_password" name="current_password"  placeholder="Current Password" type="password" />
<x-input-error class="mt-2 text-error text-xs absolute -bottom-5" :messages="$errors->updatePassword->get('current_password')" />
<label class="absolute left-4 -top-2.5 bg-surface-container-lowest px-1 font-label-caps text-label-caps text-on-surface-variant transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-body-lg peer-placeholder-shown:font-body-lg peer-focus:-top-2.5 peer-focus:text-label-caps peer-focus:font-label-caps peer-focus:text-secondary" for="current-pwd">Current Password</label>
</div>
<div class="relative">
<input  class="peer w-full bg-surface-container-lowest rounded-lg border-none px-4 py-4 font-body-lg text-body-lg text-primary placeholder-transparent focus:ring-0 shadow-sm transition-all focus:shadow-[0_0_0_1px_#8c4d42]"  id="password" name="password"  placeholder="New Password" type="password" />
<x-input-error class="mt-2 text-error text-xs absolute -bottom-5" :messages="$errors->updatePassword->get('password')" />
<label class="absolute left-4 -top-2.5 bg-surface-container-lowest px-1 font-label-caps text-label-caps text-on-surface-variant transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-body-lg peer-placeholder-shown:font-body-lg peer-focus:-top-2.5 peer-focus:text-label-caps peer-focus:font-label-caps peer-focus:text-secondary" for="new-pwd">New Password</label>
</div>
<div class="relative">
<input  class="peer w-full bg-surface-container-lowest rounded-lg border-none px-4 py-4 font-body-lg text-body-lg text-primary placeholder-transparent focus:ring-0 shadow-sm transition-all focus:shadow-[0_0_0_1px_#8c4d42]"  id="password_confirmation" name="password_confirmation"  placeholder="Confirm Password" type="password" />
<x-input-error class="mt-2 text-error text-xs absolute -bottom-5" :messages="$errors->updatePassword->get('password_confirmation')" />
<label class="absolute left-4 -top-2.5 bg-surface-container-lowest px-1 font-label-caps text-label-caps text-on-surface-variant transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-body-lg peer-placeholder-shown:font-body-lg peer-focus:-top-2.5 peer-focus:text-label-caps peer-focus:font-label-caps peer-focus:text-secondary" for="confirm-pwd">Confirm Password</label>
</div>
<button type="submit" class="w-full bg-transparent border border-primary text-primary rounded-full px-6 py-3 font-label-caps text-label-caps hover:bg-surface-container transition-colors uppercase tracking-wider mt-4">
                                Update Password
                            </button>
</form>
</div>
</section>
<!-- Danger Zone -->
<section class="border border-error/20 bg-error-container/10 rounded-xl p-8 relative overflow-hidden">
<div class="absolute right-0 top-0 w-32 h-32 bg-error/5 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2"></div>
<h3 class="font-title-lg text-title-lg text-error mb-4">Danger Zone</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-8">Once you delete your account, there is no going back. Please be certain.</p>
<button class="bg-transparent border border-error text-error rounded-full px-6 py-3 font-label-caps text-label-caps hover:bg-error hover:text-on-error transition-all uppercase tracking-wider" onclick="document.getElementById('delete-modal').classList.remove('hidden')">
                            Delete Account
                        </button>
</section>
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
