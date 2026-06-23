<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Create Account') }}</h1>
        <p class="text-sm text-gray-400 mt-1">{{ __('Register to start ordering our e-bikes') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="space-y-4">
            <div>
                <x-input-label for="name" :value="__('Name')" class="text-gray-300 mb-2" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-300 mb-2" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" class="text-gray-300 mb-2" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-300 mb-2" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 text-sm">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center border-t border-white/5 pt-6">
        <p class="text-sm text-gray-500">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}" class="text-brand hover:text-brand/80 font-semibold transition-colors">
                {{ __('Sign In') }}
            </a>
        </p>
    </div>
</x-guest-layout>
