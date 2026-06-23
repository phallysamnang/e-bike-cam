<x-admin-layout>
    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Products') }}</h1>
                <p class="text-sm text-gray-400 mt-1">{{ __('Manage your electric bike inventory') }}</p>
            </div>
            @can('create-products')
                <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 bg-brand text-darkbg font-bold px-5 py-3 rounded-xl text-sm hover:bg-brand/90 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    {{ __('Add Product') }}
                </a>
            @endcan
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5 text-left">
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Image') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Name') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Category') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Price') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-center">{{ __('Stock') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                            <td class="py-4 pr-4">
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-20 h-14 object-cover rounded-xl border border-white/5">
                            </td>
                            <td class="py-4 pr-4">
                                <span class="font-semibold text-white">{{ $product->name }}</span>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="text-sm text-gray-400">{{ $product->category->name }}</span>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="font-bold text-white">${{ number_format($product->price, 2) }}</span>
                            </td>
                            <td class="py-4 pr-4 text-center">
                                @if($product->stock > 10)
                                    <span class="text-[10px] font-bold px-3 py-1.5 rounded-full bg-brand/10 text-brand">{{ $product->stock }}</span>
                                @elseif($product->stock > 0)
                                    <span class="text-[10px] font-bold px-3 py-1.5 rounded-full bg-yellow-500/10 text-yellow-400">{{ $product->stock }}</span>
                                @else
                                    <span class="text-[10px] font-bold px-3 py-1.5 rounded-full bg-red-500/10 text-red-400">{{ __('Out') }}</span>
                                @endif
                            </td>
                            <td class="py-4">
                                <div class="flex justify-center gap-2">
                                    @can('edit-products')
                                        <a href="{{ route('products.edit', $product) }}" class="px-4 py-2 bg-blue-500/10 text-blue-400 rounded-xl text-xs font-bold hover:bg-blue-500/20 transition-colors">{{ __('Edit') }}</a>
                                    @endcan
                                    @can('delete-products')
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('{{ __('Delete this product?') }}')">
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
                            <td colspan="6" class="py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                                    </div>
                                    <p class="text-gray-500 font-medium">{{ __('No products found') }}</p>
                                    <p class="text-gray-600 text-sm mt-1">{{ __('Create your first product to get started') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
