<x-admin-layout>
    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8 max-w-3xl">
        <div class="mb-8">
            <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Edit Category') }}</h1>
            <p class="text-sm text-gray-400 mt-1">{{ __('Update category information') }}</p>
        </div>

        <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Category Name') }}</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand">
                @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-brand text-darkbg font-bold px-8 py-4 rounded-xl hover:bg-brand/90 transition-all">{{ __('Update Category') }}</button>
                <a href="{{ route('categories.index') }}" class="bg-white/5 text-gray-300 font-semibold px-8 py-4 rounded-xl hover:bg-white/10 transition-all">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-admin-layout>
