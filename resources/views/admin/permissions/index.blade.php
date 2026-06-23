<x-admin-layout>
    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Permissions') }}</h1>
                <p class="text-sm text-gray-400 mt-1">{{ __('Manage permission flags for roles') }}</p>
            </div>
            <a href="{{ route('admin.permissions.create') }}" class="inline-flex items-center gap-2 bg-brand text-darkbg font-bold px-5 py-3 rounded-xl text-sm hover:bg-brand/90 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                {{ __('Add Permission') }}
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5 text-left">
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Permission') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Slug') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Roles Using') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permissions as $permission)
                        <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                            <td class="py-4 pr-4">
                                <span class="font-semibold text-white">{{ $permission->name }}</span>
                                @if($permission->description)
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $permission->description }}</p>
                                @endif
                            </td>
                            <td class="py-4 pr-4">
                                <span class="text-xs font-mono text-gray-400 bg-white/5 px-2 py-1 rounded-lg">{{ $permission->slug }}</span>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="text-sm font-bold text-white">{{ $permission->roles_count }}</span>
                            </td>
                            <td class="py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.permissions.edit', $permission) }}" class="px-4 py-2 bg-blue-500/10 text-blue-400 rounded-xl text-xs font-bold hover:bg-blue-500/20 transition-colors">{{ __('Edit') }}</a>
                                    <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" onsubmit="return confirm('{{ __("Delete this permission? It will be removed from all roles.") }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500/10 text-red-400 rounded-xl text-xs font-bold hover:bg-red-500/20 transition-colors">{{ __('Delete') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-20 text-center">
                                <p class="text-gray-500 font-medium">{{ __('No permissions found') }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
