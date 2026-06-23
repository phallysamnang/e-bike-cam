<x-admin-layout>
    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8 max-w-3xl">
        <div class="mb-8">
            <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Create Permission') }}</h1>
            <p class="text-sm text-gray-400 mt-1">{{ __('Define a new permission flag') }}</p>
        </div>

        <form action="{{ route('admin.permissions.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Permission Name') }}</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand" placeholder="Manage Products">
                @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Slug') }}</label>
                <input type="text" name="slug" value="{{ old('slug') }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand" placeholder="manage-products">
                <p class="text-xs text-gray-500 mt-1">{{ __('Unique identifier (lowercase, hyphen-separated)') }}</p>
                @error('slug') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Description') }} <span class="text-gray-500 font-normal">({{ __('optional') }})</span></label>
                <textarea name="description" rows="2" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand" placeholder="Allows user to create, edit, and delete products">{{ old('description') }}</textarea>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-brand text-darkbg font-bold px-8 py-4 rounded-xl hover:bg-brand/90 transition-all">{{ __('Create Permission') }}</button>
                <a href="{{ route('admin.permissions.index') }}" class="bg-white/5 text-gray-300 font-semibold px-8 py-4 rounded-xl hover:bg-white/10 transition-all">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-admin-layout>
