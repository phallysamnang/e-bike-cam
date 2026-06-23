<x-admin-layout>
    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8 max-w-3xl">
        <div class="mb-8">
            <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Edit Slide') }}</h1>
            <p class="text-sm text-gray-400 mt-1">{{ __('Update slide information') }}</p>
        </div>

        <form action="{{ route('slides.update', $slide) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Slide Title') }}</label>
                <input type="text" name="title" value="{{ old('title', $slide->title) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand">
                @error('title') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Current Image') }}</label>
                <img src="{{ asset('storage/' . $slide->image) }}" class="w-32 h-20 object-cover rounded-xl border border-white/5 mb-4">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Change Image') }}</label>
                <input type="file" name="image" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-brand file:text-darkbg file:font-bold file:text-sm">
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-brand text-darkbg font-bold px-8 py-4 rounded-xl hover:bg-brand/90 transition-all">{{ __('Update Slide') }}</button>
                <a href="{{ route('slides.index') }}" class="bg-white/5 text-gray-300 font-semibold px-8 py-4 rounded-xl hover:bg-white/10 transition-all">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-admin-layout>
