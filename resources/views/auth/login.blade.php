<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Login - È VOLE</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&amp;family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="/css/theme.css">
        <script src="/js/theme.js"></script>
        <script src="/js/tailwind-config.js"></script>
<style>
        .glass-panel {
            background: rgba(251, 249, 248, 0.4);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(27, 28, 28, 0.05);
            box-shadow: 0 32px 64px -16px rgba(27, 28, 28, 0.08);
        }
        
        .bg-silk-texture {
            background-image: 
                radial-gradient(circle at 15% 50%, rgba(254, 173, 158, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 85% 30%, rgba(200, 198, 197, 0.15) 0%, transparent 50%);
            background-color: var(--color-background);
        }

        .input-elegant {
            background: transparent;
            border: none;
            border-bottom: 0.5px solid var(--color-outline-variant);
            border-radius: 0;
            padding: 12px 0;
            transition: border-color 0.3s ease;
        }

        .input-elegant:focus {
            outline: none;
            box-shadow: none;
            border-bottom-color: var(--color-secondary-container);
        }
    </style>
</head>
<body class="bg-background min-h-screen flex items-center justify-center relative overflow-hidden bg-silk-texture">
<!-- Decorative background elements to simulate fluid elegance -->
<div class="absolute inset-0 pointer-events-none overflow-hidden">
<div class="absolute -top-1/4 -left-1/4 w-[150%] h-[150%] bg-gradient-to-br from-surface-container-highest/20 to-transparent rounded-full blur-[120px] opacity-60 mix-blend-multiply"></div>
<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-secondary-container/5 via-transparent to-transparent opacity-50"></div>
</div>
<main class="w-full max-w-md px-6 relative z-10">
<!-- Glassmorphic Card -->
<div class="glass-panel rounded-xl p-10 md:p-14 flex flex-col gap-10">
<!-- Header -->
<header class="text-center space-y-3">
<h1 class="font-display-md text-display-md text-primary">È VOLE</h1>
<p class="font-body-md text-body-md text-on-surface-variant">Fluid Elegance in Advertising</p>
</header>
<!-- Form -->
<x-auth-session-status class="mb-4" :status="session('status')" />
<form action="{{ route('login') }}" class="flex flex-col gap-8" method="POST">
    @csrf
<div class="space-y-6">
<!-- Email Input -->
<div class="relative group">
<label class="sr-only" for="email">Email address</label>
<input class="input-elegant w-full font-body-md text-body-md text-on-surface placeholder-on-surface-variant/50 focus:ring-0" id="email" name="email" value="{{ old('email') }}" placeholder="Email address" required="" type="email" autofocus autocomplete="username" />
<x-input-error :messages="$errors->get('email')" class="mt-2 text-error text-xs" />
<span class="material-symbols-outlined absolute right-0 top-3 text-on-surface-variant/50 pointer-events-none transition-colors group-focus-within:text-secondary-container">
                            mail
                        </span>
</div>
<!-- Password Input -->
<div class="relative group">
<label class="sr-only" for="password">Password</label>
<input class="input-elegant w-full font-body-md text-body-md text-on-surface placeholder-on-surface-variant/50 focus:ring-0" id="password" name="password" placeholder="Password" required="" type="password" autocomplete="current-password" />
<x-input-error :messages="$errors->get('password')" class="mt-2 text-error text-xs" />
<span class="material-symbols-outlined absolute right-0 top-3 text-on-surface-variant/50 pointer-events-none transition-colors group-focus-within:text-secondary-container">
                            lock
                        </span>
</div>
</div>
<!-- Remember Me -->
<div class="block mt-4">
    <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox" class="rounded border-outline-variant text-primary shadow-sm focus:ring-primary" name="remember">
        <span class="ms-2 text-sm text-on-surface-variant">{{ __('Remember me') }}</span>
    </label>
</div>

<!-- Actions -->
<div class="flex flex-col gap-6 pt-2">
<button class="w-full bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest py-4 rounded-full transition-all duration-300 hover:bg-secondary-container hover:text-on-secondary-container hover:shadow-[0_8px_24px_-8px_rgba(254,173,158,0.4)] active:scale-[0.98]" type="submit">
                        Sign In
                    </button>
@if (Route::has('password.request'))
    <a class="text-center font-body-md text-body-md text-on-surface-variant hover:text-secondary-container transition-colors duration-300" href="{{ route('password.request') }}">
        Forgot Password?
    </a>
@endif
</div>
</form>
</div>
</main>
<!-- Footer Component logic contextually ignored as per instructions for transactional pages -->
</body></html>
