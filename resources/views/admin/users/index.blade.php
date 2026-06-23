<x-admin-layout>
    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Users') }}</h1>
                <p class="text-sm text-gray-400 mt-1">{{ __('Manage user accounts and role assignments') }}</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5 text-left">
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Name') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Email') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Roles') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Joined') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                            <td class="py-4 pr-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-brand/10 flex items-center justify-center text-xs font-bold text-brand">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <span class="font-semibold text-white">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="text-sm text-gray-400">{{ $user->email }}</span>
                            </td>
                            <td class="py-4 pr-4">
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse($user->roles as $role)
                                        <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full {{ $role->slug === 'admin' ? 'bg-brand/10 text-brand' : 'bg-blue-500/10 text-blue-400' }}">
                                            {{ $role->name }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-600">{{ __('No role') }}</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="text-sm text-gray-400">{{ $user->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="px-4 py-2 bg-blue-500/10 text-blue-400 rounded-xl text-xs font-bold hover:bg-blue-500/20 transition-colors">{{ __('Edit') }}</a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('{{ __('Delete this user?') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-500/10 text-red-400 rounded-xl text-xs font-bold hover:bg-red-500/20 transition-colors">{{ __('Delete') }}</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-20 text-center">
                                <p class="text-gray-500 font-medium">{{ __('No users found') }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
