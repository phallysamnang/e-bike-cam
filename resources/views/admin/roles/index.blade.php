<x-admin-layout>
    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Roles') }}</h1>
                <p class="text-sm text-gray-400 mt-1">{{ __('Define roles and assign permissions') }}</p>
            </div>
            <a href="{{ route('admin.roles.create') }}" class="inline-flex items-center gap-2 bg-brand text-darkbg font-bold px-5 py-3 rounded-xl text-sm hover:bg-brand/90 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                {{ __('Add Role') }}
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5 text-left">
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Role') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Slug') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Users') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Permissions') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                        <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                            <td class="py-4 pr-4">
                                <span class="font-semibold text-white">{{ $role->name }}</span>
                                @if($role->description)
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $role->description }}</p>
                                @endif
                            </td>
                            <td class="py-4 pr-4">
                                <span class="text-xs font-mono text-gray-400 bg-white/5 px-2 py-1 rounded-lg">{{ $role->slug }}</span>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="text-sm font-bold text-white">{{ $role->users_count }}</span>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="text-sm font-bold text-white">{{ $role->permissions_count }}</span>
                            </td>
                            <td class="py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="px-4 py-2 bg-blue-500/10 text-blue-400 rounded-xl text-xs font-bold hover:bg-blue-500/20 transition-colors">{{ __('Edit') }}</a>
                                    @if($role->slug !== 'admin')
                                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" onsubmit="return confirm('{{ __('Delete this role?') }}')">
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
                                <p class="text-gray-500 font-medium">{{ __('No roles found') }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
