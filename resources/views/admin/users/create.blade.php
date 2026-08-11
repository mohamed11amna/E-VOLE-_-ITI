<x-admin-layout>
    <header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-8 mb-12">
        <div class="flex flex-col gap-4 max-w-2xl">
            <h1 class="font-display-lg text-display-lg text-primary">Add New User</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl">
                Create a new user account on the platform.
            </p>
        </div>
        <div class="flex gap-4 items-center shrink-0">
            <a href="{{ route('admin.users.index') }}" class="flex items-center justify-center px-6 py-3 rounded-full bg-surface-container border border-outline/10 text-primary font-body-md text-body-md hover:bg-surface-container-high transition-colors duration-300">
                Cancel
            </a>
        </div>
    </header>

    <div class="max-w-3xl glass-layer rounded-2xl p-8 md:p-12">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="name" class="block font-label-lg text-label-lg text-primary mb-2">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full bg-surface/50 border border-outline/20 rounded-xl px-4 py-3 text-primary focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all">
                    @error('name') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block font-label-lg text-label-lg text-primary mb-2">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="w-full bg-surface/50 border border-outline/20 rounded-xl px-4 py-3 text-primary focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all">
                    @error('email') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block font-label-lg text-label-lg text-primary mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full bg-surface/50 border border-outline/20 rounded-xl px-4 py-3 text-primary focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all">
                    @error('password') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block font-label-lg text-label-lg text-primary mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="w-full bg-surface/50 border border-outline/20 rounded-xl px-4 py-3 text-primary focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all">
                </div>

                <div class="pt-4 pb-2 border-t border-outline/10">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}
                               class="w-5 h-5 rounded border-outline/30 text-secondary focus:ring-secondary focus:ring-offset-background bg-surface/50">
                        <span class="font-body-md text-primary">Grant Administrator Privileges</span>
                    </label>
                    <p class="text-on-surface-variant text-sm mt-2 ml-8">Warning: Administrators have full access to view and manage all campaigns, users, and system settings.</p>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full md:w-auto px-10 py-4 rounded-full bg-primary text-on-primary font-body-lg text-body-lg hover:bg-secondary transition-colors duration-300">
                    Create User
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
