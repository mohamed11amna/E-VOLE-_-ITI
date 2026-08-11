<x-guest-layout>
    <div class="mb-8">
        <h2 class="font-headline-lg text-headline-lg text-primary">Reset Password</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2 leading-relaxed">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 p-4 rounded-xl border border-secondary/20 bg-secondary-container/20 text-on-secondary-container text-sm" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('Email Address') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-0 text-primary transition-colors placeholder:text-on-surface-variant/50" 
                placeholder="designer@È VOLE.ai" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-error text-xs" />
        </div>

        <div class="pt-4 flex items-center justify-between">
            <a href="{{ route('login') }}" class="text-sm text-secondary hover:text-primary transition-colors font-medium flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Back to Login
            </a>
            <button type="submit" class="bg-primary text-on-primary font-body-md px-6 py-3.5 rounded-full hover:bg-secondary transition-colors duration-300 shadow-sm flex items-center justify-center gap-2">
                <span>{{ __('Email Reset Link') }}</span>
                <span class="material-symbols-outlined text-[18px]">send</span>
            </button>
        </div>
    </form>
</x-guest-layout>

