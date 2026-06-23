<x-admin-layout>
    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Slides') }}</h1>
                <p class="text-sm text-gray-400 mt-1">{{ __('Manage homepage slideshow banners') }}</p>
            </div>
            @can('create-slides')
                <a href="{{ route('slides.create') }}" class="inline-flex items-center gap-2 bg-brand text-darkbg font-bold px-5 py-3 rounded-xl text-sm hover:bg-brand/90 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    {{ __('Add Slide') }}
                </a>
            @endcan
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5 text-left">
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Banner') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Title') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Status') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Created') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slides as $slide)
                        <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                            <td class="py-4 pr-4">
                                <img src="{{ asset('storage/' . $slide->image) }}" class="w-20 h-14 object-cover rounded-xl border border-white/5">
                            </td>
                            <td class="py-4 pr-4">
                                <span class="font-semibold text-white">{{ $slide->title }}</span>
                                <p class="text-xs text-gray-500 mt-0.5">{{ __('Homepage Hero Banner') }}</p>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="bg-brand/10 text-brand px-3 py-1 rounded-full text-xs font-bold">{{ __('Active') }}</span>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="text-sm text-gray-400">{{ $slide->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="py-4">
                                <div class="flex justify-center gap-2">
                                    @can('edit-slides')
                                        <a href="{{ route('slides.edit', $slide) }}" class="px-4 py-2 bg-blue-500/10 text-blue-400 rounded-xl text-xs font-bold hover:bg-blue-500/20 transition-colors">{{ __('Edit') }}</a>
                                    @endcan
                                    @can('delete-slides')
                                        <form action="{{ route('slides.destroy', $slide) }}" method="POST" onsubmit="return confirm('{{ __('Delete this slide?') }}')">
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
                            <td colspan="5" class="py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    </div>
                                    <p class="text-gray-500 font-medium">{{ __('No slides found') }}</p>
                                    <p class="text-gray-600 text-sm mt-1">{{ __('Create your first homepage banner') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
