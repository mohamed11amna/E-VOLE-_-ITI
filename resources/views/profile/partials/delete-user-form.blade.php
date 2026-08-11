<section class="space-y-6">
    <header>
        <h2 class="font-headline-lg text-headline-lg text-error">
            {{ __('Danger Zone') }}
        </h2>

        <p class="mt-2 font-body-md text-error/80 max-w-2xl">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="!bg-error !text-on-error hover:!bg-error/90 !rounded-full !px-6 !py-3 font-body-md"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-surface-container-lowest rounded-2xl border border-error/20 relative overflow-hidden">
            @csrf
            @method('delete')

            <div class="absolute top-0 right-0 w-32 h-32 bg-error/10 rounded-full blur-[40px] -mr-16 -mt-16"></div>

            <div class="relative z-10">
                <h2 class="font-headline-lg text-headline-lg text-error">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-2 font-body-md text-on-surface-variant max-w-xl">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-8 space-y-2">
                    <label for="password" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('Password') }}</label>
                    <input id="password" name="password" type="password" placeholder="••••••••"
                        class="w-full sm:w-3/4 bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-error focus:ring-0 text-primary transition-colors" />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-error text-xs" />
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close')" class="bg-surface-container-high text-on-surface font-body-md px-6 py-3 rounded-full hover:bg-surface-variant transition-colors duration-300">
                        {{ __('Cancel') }}
                    </button>

                    <button type="submit" class="bg-error text-on-error font-body-md px-6 py-3 rounded-full hover:bg-error/90 transition-colors duration-300 shadow-sm">
                        {{ __('Permanently Delete') }}
                    </button>
                </div>
            </div>
        </form>
    </x-modal>
</section>
