<section>
    <header>
        <h2 class="font-headline-lg text-headline-lg text-primary">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-2 font-body-md text-on-surface-variant max-w-2xl">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="space-y-2">
            <label for="update_password_current_password" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                class="w-full sm:w-1/2 bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-0 text-primary transition-colors" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-error text-xs" />
        </div>

        <!-- New Password -->
        <div class="space-y-2">
            <label for="update_password_password" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                class="w-full sm:w-1/2 bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-0 text-primary transition-colors" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-error text-xs" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <label for="update_password_password_confirmation" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                class="w-full sm:w-1/2 bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-0 text-primary transition-colors" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-error text-xs" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-outline-variant/20">
            <button type="submit" class="bg-primary text-on-primary font-body-md px-8 py-3 rounded-full hover:bg-secondary transition-colors duration-300 shadow-sm">
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-secondary font-medium flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
