<x-admin-layout>
    <header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-8 mb-12">
        <div class="flex flex-col gap-4 max-w-2xl">
            <h1 class="font-display-lg text-display-lg text-primary">Manage Users</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl">
                View, edit, or remove users from the platform.
            </p>
        </div>
        <div class="flex gap-4 items-center shrink-0">
            <a href="{{ route('admin.users.create') }}" class="flex items-center justify-center gap-2 px-6 py-3 rounded-full bg-primary text-on-primary font-body-md text-body-md hover:bg-secondary transition-colors duration-300">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Add New User
            </a>
        </div>
    </header>

    @if(session('success'))
        <div class="bg-surface-container-high text-primary px-6 py-4 rounded-xl mb-8 border border-outline/10 flex items-center gap-3">
            <span class="material-symbols-outlined text-secondary">check_circle</span>
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-error/10 text-error px-6 py-4 rounded-xl mb-8 border border-error/20 flex items-center gap-3">
            <span class="material-symbols-outlined">error</span>
            {{ session('error') }}
        </div>
    @endif

    <div class="glass-layer rounded-2xl p-8 overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="border-b border-outline/10 text-on-surface-variant font-label-caps text-label-caps tracking-wider">
                    <th class="py-4 px-4 font-normal">Name</th>
                    <th class="py-4 px-4 font-normal">Email</th>
                    <th class="py-4 px-4 font-normal">Role</th>
                    <th class="py-4 px-4 font-normal">Joined</th>
                    <th class="py-4 px-4 font-normal text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b border-outline/5 hover:bg-surface-variant/20 transition-colors">
                    <td class="py-4 px-4 text-primary font-body-md font-medium">
                        <div class="flex items-center gap-3">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" class="w-8 h-8 rounded-full object-cover">
                            @else
                                <div class="w-8 h-8 rounded-full bg-surface-container border border-outline/10 flex items-center justify-center text-xs font-semibold text-primary">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                            {{ $user->name }}
                        </div>
                    </td>
                    <td class="py-4 px-4 text-on-surface-variant font-body-md text-sm">{{ $user->email }}</td>
                    <td class="py-4 px-4">
                        @if($user->is_admin)
                            <span class="bg-secondary/10 text-secondary px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase">Admin</span>
                        @else
                            <span class="bg-surface-container text-on-surface-variant px-3 py-1 rounded-full text-xs font-medium tracking-wide">User</span>
                        @endif
                    </td>
                    <td class="py-4 px-4 text-on-surface-variant font-body-md text-sm">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="py-4 px-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="p-2 text-on-surface-variant hover:text-primary transition-colors rounded-full hover:bg-surface-container-high" title="Edit User">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </a>
                            
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to completely delete this user? This cannot be undone.');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-on-surface-variant hover:text-error transition-colors rounded-full hover:bg-error/10" title="Delete User">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-8">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>
