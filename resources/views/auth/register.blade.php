<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Register - È VOLE</title>
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
        .glass-panel {
            background: rgba(251, 249, 248, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        /* Subtle glowing orb effect behind the form */
        .ambient-glow {
            position: absolute;
            width: 60vh;
            height: 60vh;
            background: radial-gradient(circle, rgba(254, 173, 158, 0.15) 0%, rgba(251, 249, 248, 0) 70%);
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            pointer-events: none;
        }
      </style>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col md:flex-row antialiased font-body-lg selection:bg-secondary selection:text-on-secondary">
<!-- Left Column: Editorial Image -->
<div class="hidden md:flex md:w-5/12 lg:w-1/2 relative h-screen sticky top-0 overflow-hidden">
<!-- Diffused shadow overlay for transition -->
<div class="absolute inset-0 bg-gradient-to-r from-transparent to-background/90 z-10"></div>
<img alt="È VOLE Conceptual Imagery" class="object-cover w-full h-full scale-105 origin-center transition-transform duration-1000 ease-out hover:scale-100" data-alt="A striking, high-fashion editorial photograph of an elegant model interacting with floating, luminous digital interfaces in a vast, minimalist studio bathed in soft, diffused lighting. The color palette emphasizes rich charcoal blacks, pristine champagne whites, and subtle accents of soft rose. The mood is sophisticated, authoritative, and futuristic, evoking a seamless blend of luxury couture and advanced enterprise AI." src="/images/register_bg.png"/>
</div>
<!-- Right Column: Registration Form -->
<div class="w-full md:w-7/12 lg:w-1/2 min-h-screen flex items-center justify-center relative p-6 md:p-12 lg:p-container-padding z-20">
<div class="ambient-glow hidden md:block"></div>
<div class="w-full max-w-lg relative">
<!-- Brand Element -->
<div class="mb-16">
<h1 class="font-display-md text-display-md md:text-display-lg font-display-lg text-primary tracking-tight">
                    È VOLE.
                </h1>
<p class="font-body-lg text-body-lg text-on-surface-variant mt-4 max-w-sm">
                    Fluid Elegance in Advertising. Join the vanguard of luxury brand intelligence.
                </p>
</div>
<!-- Form Container -->
<div class="glass-panel rounded-xl p-8 md:p-12 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)]">
<form class="space-y-10" method="POST" action="{{ route('register') }}">
    @csrf
<!-- Full Name -->
<div class="relative group">
<input class="peer w-full bg-transparent border-0 border-b-[0.5px] border-primary/20 text-primary font-body-lg text-body-lg py-3 px-0 focus:ring-0 focus:border-secondary transition-colors duration-300 placeholder-transparent" id="name" name="name" value="{{ old('name') }}" placeholder="Full Name" required autofocus autocomplete="name" type="text"/>
<x-input-error :messages="$errors->get('name')" class="mt-2 text-error text-xs" />
<label class="absolute left-0 top-3 font-body-md text-body-md text-on-surface-variant/70 transition-all duration-300 peer-focus:-top-5 peer-focus:text-label-caps peer-focus:font-label-caps peer-focus:text-secondary peer-valid:-top-5 peer-valid:text-label-caps peer-valid:font-label-caps cursor-text" for="name">
                            Full Name
                        </label>
</div>
<!-- Professional Email -->
<div class="relative group">
<input class="peer w-full bg-transparent border-0 border-b-[0.5px] border-primary/20 text-primary font-body-lg text-body-lg py-3 px-0 focus:ring-0 focus:border-secondary transition-colors duration-300 placeholder-transparent" id="email" name="email" value="{{ old('email') }}" placeholder="Professional Email" required autocomplete="username" type="email"/>
<x-input-error :messages="$errors->get('email')" class="mt-2 text-error text-xs" />
<label class="absolute left-0 top-3 font-body-md text-body-md text-on-surface-variant/70 transition-all duration-300 peer-focus:-top-5 peer-focus:text-label-caps peer-focus:font-label-caps peer-focus:text-secondary peer-valid:-top-5 peer-valid:text-label-caps peer-valid:font-label-caps cursor-text" for="email">
                            Professional Email
                        </label>
</div>
<!-- Create Password -->
<div class="relative group">
<input class="peer w-full bg-transparent border-0 border-b-[0.5px] border-primary/20 text-primary font-body-lg text-body-lg py-3 px-0 focus:ring-0 focus:border-secondary transition-colors duration-300 placeholder-transparent" id="password" name="password" placeholder="Create Password" required autocomplete="new-password" type="password"/>
<x-input-error :messages="$errors->get('password')" class="mt-2 text-error text-xs" />
<label class="absolute left-0 top-3 font-body-md text-body-md text-on-surface-variant/70 transition-all duration-300 peer-focus:-top-5 peer-focus:text-label-caps peer-focus:font-label-caps peer-focus:text-secondary peer-valid:-top-5 peer-valid:text-label-caps peer-valid:font-label-caps cursor-text" for="password">
                            Create Password
                        </label>
</div>

<!-- Confirm Password -->
<div class="relative group mt-10">
<input class="peer w-full bg-transparent border-0 border-b-[0.5px] border-primary/20 text-primary font-body-lg text-body-lg py-3 px-0 focus:ring-0 focus:border-secondary transition-colors duration-300 placeholder-transparent" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" type="password"/>
<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-error text-xs" />
<label class="absolute left-0 top-3 font-body-md text-body-md text-on-surface-variant/70 transition-all duration-300 peer-focus:-top-5 peer-focus:text-label-caps peer-focus:font-label-caps peer-focus:text-secondary peer-valid:-top-5 peer-valid:text-label-caps peer-valid:font-label-caps cursor-text" for="password_confirmation">
                            Confirm Password
                        </label>
</div>
<!-- Actions -->
<div class="pt-6 flex flex-col gap-6 items-center">
<button class="w-full rounded-full bg-primary text-on-primary font-title-lg text-title-lg py-4 px-8 hover:bg-secondary hover:text-on-secondary hover:shadow-[0_8px_20px_rgba(140,77,66,0.3)] transform hover:-translate-y-0.5 transition-all duration-300 ease-out flex justify-center items-center gap-2" type="submit">
<span>Create Account</span>
<span class="material-symbols-outlined text-[20px]">arrow_forward</span>
</button>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-secondary transition-colors duration-300 group inline-flex items-center gap-1" href="{{ route('login') }}">
                            Already have an account? <span class="group-hover:underline underline-offset-4 decoration-[0.5px]">Back to Login</span>
</a>
</div>
</form>
</div>
<div class="mt-12 text-center text-on-surface-variant/50 font-body-md text-body-md max-w-xs mx-auto">
                By creating an account, you agree to our Terms of Service and Privacy Policy.
            </div>
</div>
</div>
</body></html>
