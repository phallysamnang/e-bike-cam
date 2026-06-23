<x-admin-layout>
    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8 max-w-3xl">
        <div class="mb-8">
            <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Edit Product') }}</h1>
            <p class="text-sm text-gray-400 mt-1">{{ __('Update product information') }}</p>
        </div>

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Category') }}</label>
                <select name="category_id" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" class="bg-darkbg" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Product Name') }}</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand">
                @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Price') }} ($)</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand">
                    @error('price') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Stock') }}</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Battery Range') }}</label>
                    <input type="text" name="battery_range" value="{{ old('battery_range', $product->battery_range) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Top Speed') }}</label>
                    <input type="text" name="top_speed" value="{{ old('top_speed', $product->top_speed) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Description') }}</label>
                <textarea name="description" rows="4" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand">{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Current Image') }}</label>
                <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-20 object-cover rounded-xl border border-white/5 mb-4">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Change Image') }}</label>
                <input type="file" name="image" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-brand file:text-darkbg file:font-bold file:text-sm">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="featured" id="featured" class="rounded bg-white/5 border-white/10 text-brand focus:ring-brand" {{ $product->featured ? 'checked' : '' }}>
                <label for="featured" class="text-sm font-medium text-gray-300">{{ __('Featured Product') }}</label>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-brand text-darkbg font-bold px-8 py-4 rounded-xl hover:bg-brand/90 transition-all">{{ __('Update Product') }}</button>
                <a href="{{ route('products.index') }}" class="bg-white/5 text-gray-300 font-semibold px-8 py-4 rounded-xl hover:bg-white/10 transition-all">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-admin-layout>
