<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Sign In') }}</h1>
        <p class="text-sm text-gray-400 mt-1">{{ __('Sign in to browse and order our e-bikes') }}</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="space-y-4">
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-300 mb-2" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" class="text-gray-300 mb-2" />
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded bg-white/5 border-white/10 text-brand focus:ring-brand" name="remember">
                    <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-500 hover:text-brand transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 text-sm">
                {{ __('Sign In') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center border-t border-white/5 pt-6">
        <p class="text-sm text-gray-500">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}" class="text-brand hover:text-brand/80 font-semibold transition-colors">
                {{ __('Register') }}
            </a>
        </p>
    </div>
</x-guest-layout>
