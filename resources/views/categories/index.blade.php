<x-admin-layout>
    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Categories') }}</h1>
                <p class="text-sm text-gray-400 mt-1">{{ __('Manage electric bike categories') }}</p>
            </div>
            @can('create-categories')
                <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 bg-brand text-darkbg font-bold px-5 py-3 rounded-xl text-sm hover:bg-brand/90 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    {{ __('Add Category') }}
                </a>
            @endcan
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5 text-left">
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Name') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Created') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                            <td class="py-4 pr-4">
                                <span class="font-semibold text-white">{{ $category->name }}</span>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="text-sm text-gray-400">{{ $category->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="py-4">
                                <div class="flex justify-center gap-2">
                                    @can('edit-categories')
                                    <a href="{{ route('categories.edit', $category) }}" class="px-4 py-2 bg-blue-500/10 text-blue-400 rounded-xl text-xs font-bold hover:bg-blue-500/20 transition-colors">{{ __('Edit') }}</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('{{ __('Delete this category?') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500/10 text-red-400 rounded-xl text-xs font-bold hover:bg-red-500/20 transition-colors">{{ __('Delete') }}</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                    </div>
                                    <p class="text-gray-500 font-medium">{{ __('No categories found') }}</p>
                                    <p class="text-gray-600 text-sm mt-1">Create your first category to get started</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
