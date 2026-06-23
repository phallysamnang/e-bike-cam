<x-admin-layout>
    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
        <h1 class="text-2xl font-black text-white">{{ __('Dashboard') }}</h1>
        <p class="text-sm text-gray-400 mt-2">{{ __('Welcome back') }}, {{ Auth::user()->name ?? 'Admin' }}. {{ __('Manage your store from here') }}.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-brand/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                </div>
                <div>
                    <p class="text-3xl font-black text-white">{{ $products->count() }}</p>
                    <p class="text-sm text-gray-400">{{ __('Total Products') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-brand/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                </div>
                <div>
                    <p class="text-3xl font-black text-white">{{ $categories->count() }}</p>
                    <p class="text-sm text-gray-400">{{ __('Total Categories') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-brand/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <div>
                    <p class="text-3xl font-black text-white">{{ $slides_count ?? 0 }}</p>
                    <p class="text-sm text-gray-400">{{ __('Total Slides') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
