<section>
    <header>
        <h2 class="font-headline-lg text-headline-lg text-primary">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 font-body-md text-on-surface-variant max-w-2xl">
            {{ __("Update your account's profile information, avatar, and professional details.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-8 space-y-8">
        @csrf
        @method('patch')

        <!-- Avatar Upload Section -->
        <div class="flex items-center gap-6 pb-6 border-b border-outline-variant/20">
            <div class="relative w-24 h-24 rounded-full overflow-hidden bg-surface-container-high border-2 border-outline-variant/30 flex-shrink-0 group">
                @if($user->avatar)
                    <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-[32px]">person</span>
                    </div>
                @endif
                <div class="absolute inset-0 bg-primary/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="material-symbols-outlined text-on-primary">upload</span>
                </div>
                <input type="file" name="avatar" id="avatar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
            </div>
            <div>
                <label for="avatar" class="font-title-lg text-primary block mb-1">Profile Picture</label>
                <p class="font-body-md text-sm text-on-surface-variant">Click the image to upload a new avatar. Max size 2MB.</p>
                <x-input-error class="mt-2 text-error text-xs" :messages="$errors->get('avatar')" />
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('Name') }}</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                    class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-0 text-primary transition-colors" />
                <x-input-error class="mt-2 text-error text-xs" :messages="$errors->get('name')" />
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                    class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-0 text-primary transition-colors" />
                <x-input-error class="mt-2 text-error text-xs" :messages="$errors->get('email')" />
                
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-3 p-3 rounded-lg bg-secondary-container/20 border border-secondary/20">
                        <p class="text-sm text-on-secondary-container">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="underline text-sm hover:text-primary transition-colors">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-secondary">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Job Title -->
            <div class="space-y-2">
                <label for="job_title" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('Job Title') }}</label>
                <input id="job_title" name="job_title" type="text" value="{{ old('job_title', $user->job_title) }}" placeholder="e.g. Creative Director"
                    class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-0 text-primary transition-colors" />
                <x-input-error class="mt-2 text-error text-xs" :messages="$errors->get('job_title')" />
            </div>

            <!-- Company -->
            <div class="space-y-2">
                <label for="company" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('Company') }}</label>
                <input id="company" name="company" type="text" value="{{ old('company', $user->company) }}" placeholder="e.g. È VOLE Agency"
                    class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-0 text-primary transition-colors" />
                <x-input-error class="mt-2 text-error text-xs" :messages="$errors->get('company')" />
            </div>
        </div>

        <!-- Bio -->
        <div class="space-y-2">
            <label for="bio" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('Bio') }}</label>
            <textarea id="bio" name="bio" rows="4" placeholder="Tell us a little about your creative background..."
                class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-0 text-primary transition-colors resize-none">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2 text-error text-xs" :messages="$errors->get('bio')" />
        </div>

        <!-- Social & Professional Links Section -->
        <div class="pt-6 mt-8 border-t border-outline-variant/20">
            <h3 class="font-title-lg text-primary mb-6">{{ __('Professional Presence') }}</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Expertise -->
                <div class="space-y-2">
                    <label for="expertise" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('Expertise') }}</label>
                    <input id="expertise" name="expertise" type="text" value="{{ old('expertise', $user->expertise) }}" placeholder="e.g. Design, Marketing"
                        class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-0 text-primary transition-colors" />
                    <x-input-error class="mt-2 text-error text-xs" :messages="$errors->get('expertise')" />
                </div>

                <!-- Portfolio/Website -->
                <div class="space-y-2">
                    <label for="website_link" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('Portfolio/Website Link') }}</label>
                    <input id="website_link" name="website_link" type="url" value="{{ old('website_link', $user->website_link) }}" placeholder="https://example.com"
                        class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-0 text-primary transition-colors" />
                    <x-input-error class="mt-2 text-error text-xs" :messages="$errors->get('website_link')" />
                </div>

                <!-- LinkedIn -->
                <div class="space-y-2">
                    <label for="linkedin_profile" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('LinkedIn Profile') }}</label>
                    <input id="linkedin_profile" name="linkedin_profile" type="url" value="{{ old('linkedin_profile', $user->linkedin_profile) }}" placeholder="https://linkedin.com/in/username"
                        class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-0 text-primary transition-colors" />
                    <x-input-error class="mt-2 text-error text-xs" :messages="$errors->get('linkedin_profile')" />
                </div>

                <!-- Twitter -->
                <div class="space-y-2">
                    <label for="twitter_profile" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('Twitter Profile') }}</label>
                    <input id="twitter_profile" name="twitter_profile" type="url" value="{{ old('twitter_profile', $user->twitter_profile) }}" placeholder="https://twitter.com/username"
                        class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-0 text-primary transition-colors" />
                    <x-input-error class="mt-2 text-error text-xs" :messages="$errors->get('twitter_profile')" />
                </div>

                <!-- Affiliate Partner -->
                <div class="space-y-2 sm:col-span-2">
                    <label for="affiliate_partner" class="font-label-caps text-label-caps text-primary uppercase tracking-widest block">{{ __('Affiliate Partner (if any)') }}</label>
                    <input id="affiliate_partner" name="affiliate_partner" type="text" value="{{ old('affiliate_partner', $user->affiliate_partner) }}" placeholder="Enter referral code"
                        class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary focus:ring-0 text-primary transition-colors" />
                    <p class="mt-1 text-xs text-on-surface-variant font-body-sm">If you were referred by a partner, enter their code here.</p>
                    <x-input-error class="mt-2 text-error text-xs" :messages="$errors->get('affiliate_partner')" />
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-6 border-t border-outline-variant/20">
            <button type="submit" class="bg-primary text-on-primary font-body-md px-8 py-3 rounded-full hover:bg-secondary transition-colors duration-300 shadow-sm">
                {{ __('Save Profile') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-secondary font-medium flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>

