<x-admin-layout>
    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8 max-w-3xl">
        <div class="mb-8">
            <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Create Role') }}</h1>
            <p class="text-sm text-gray-400 mt-1">{{ __('Define a new role with permissions') }}</p>
        </div>

        <form action="{{ route('admin.roles.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Role Name') }}</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand" placeholder="Editor">
                @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Slug') }}</label>
                <input type="text" name="slug" value="{{ old('slug') }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand" placeholder="editor">
                <p class="text-xs text-gray-500 mt-1">{{ __('Unique identifier (lowercase, no spaces)') }}</p>
                @error('slug') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Description') }} <span class="text-gray-500 font-normal">({{ __('optional') }})</span></label>
                <textarea name="description" rows="2" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-3">{{ __('Permissions') }}</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    @foreach($permissions as $permission)
                        <label class="flex items-center gap-3 p-3 rounded-xl bg-white/[0.02] border border-white/5 cursor-pointer hover:bg-white/[0.04] transition-colors">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="rounded bg-white/5 border-white/10 text-brand focus:ring-brand">
                            <div>
                                <span class="font-semibold text-white text-sm">{{ $permission->name }}</span>
                                @if($permission->description)
                                    <p class="text-xs text-gray-500">{{ $permission->description }}</p>
                                @endif
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-brand text-darkbg font-bold px-8 py-4 rounded-xl hover:bg-brand/90 transition-all">{{ __('Create Role') }}</button>
                <a href="{{ route('admin.roles.index') }}" class="bg-white/5 text-gray-300 font-semibold px-8 py-4 rounded-xl hover:bg-white/10 transition-all">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-admin-layout>
