@extends('layouts.app')

@section('content')
<div class="pt-32 pb-16 bg-[#0f1115] min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        <a href="/#bikes" class="inline-flex items-center gap-2 text-gray-400 hover:text-brand transition-colors mb-8 text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            {{ __('Back to Bikes') }}
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="relative">
                <div class="w-full aspect-[4/3] rounded-[2rem] overflow-hidden bg-[#161920] border border-white/5">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
                @if($product->featured)
                    <div class="absolute top-4 left-4 px-3 py-1.5 bg-brand text-darkbg text-xs font-bold rounded-full">
                        {{ __('Featured') }}
                    </div>
                @endif
            </div>

            <div class="space-y-6">
                <div>
                    <span class="text-xs font-bold tracking-widest text-brand uppercase block mb-2">
                        {{ $product->category->name }}
                    </span>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">{{ $product->name }}</h1>
                </div>

                <div class="text-4xl font-black text-brand">
                    ${{ number_format($product->price, 2) }}
                </div>

                @if($product->description)
                    <p class="text-gray-400 font-light leading-relaxed">{{ $product->description }}</p>
                @endif

                <div class="grid grid-cols-2 gap-4">
                    @if($product->battery_range)
                        <div class="bg-white/[0.02] border border-white/5 rounded-2xl p-5">
                            <div class="w-10 h-10 rounded-xl bg-brand/10 flex items-center justify-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </div>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">{{ __('Battery Range') }}</p>
                            <p class="text-lg font-bold text-white">{{ $product->battery_range }}</p>
                        </div>
                    @endif
                    @if($product->top_speed)
                        <div class="bg-white/[0.02] border border-white/5 rounded-2xl p-5">
                            <div class="w-10 h-10 rounded-xl bg-brand/10 flex items-center justify-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">{{ __('Top Speed') }}</p>
                            <p class="text-lg font-bold text-white">{{ $product->top_speed }}</p>
                        </div>
                    @endif
                    <div class="bg-white/[0.02] border border-white/5 rounded-2xl p-5">
                        <div class="w-10 h-10 rounded-xl {{ $product->stock > 0 ? 'bg-brand/10' : 'bg-red-500/10' }} flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ $product->stock > 0 ? 'text-brand' : 'text-red-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                        </div>
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">{{ __('Stock') }}</p>
                        @if($product->stock > 0)
                            <p class="text-lg font-bold {{ $product->stock > 5 ? 'text-white' : 'text-yellow-400' }}">{{ $product->stock }} {{ __('Units') }}</p>
                        @else
                            <p class="text-lg font-bold text-red-400">{{ __('Out of Stock') }}</p>
                        @endif
                    </div>
                    <div class="bg-white/[0.02] border border-white/5 rounded-2xl p-5">
                        <div class="w-10 h-10 rounded-xl bg-brand/10 flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        </div>
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">{{ __('Warranty') }}</p>
                        <p class="text-lg font-bold text-white">2 {{ __('Years') }}</p>
                    </div>
                </div>

                @auth
                    @if($product->stock > 0)
                        <a href="{{ route('order.create', $product) }}" class="w-full bg-brand text-darkbg font-bold px-8 py-4 rounded-xl hover:bg-brand/90 transition-all text-lg flex items-center justify-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" /></svg>
                            {{ __('Order Now') }}
                        </a>
                    @else
                        <button disabled class="w-full bg-gray-500/20 text-gray-500 font-bold px-8 py-4 rounded-xl text-lg flex items-center justify-center gap-3 cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" /></svg>
                            {{ __('Out of Stock') }}
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="w-full bg-white/5 text-gray-300 font-bold px-8 py-4 rounded-xl hover:bg-white/10 transition-all text-lg flex items-center justify-center gap-3 border border-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                        {{ __('Sign In to Order') }}
                    </a>
                @endauth
            </div>
        </div>

        @if($related->isNotEmpty())
            <div class="mt-24">
                <div class="mb-10">
                    <span class="text-xs font-bold tracking-widest text-brand uppercase block mb-3">{{ __('Related') }}</span>
                    <h2 class="text-3xl font-extrabold text-white tracking-tight">{{ __('Similar E-Bikes') }}</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($related as $rel)
                        <a href="{{ route('product.show', $rel) }}" class="group bg-[#161920] rounded-[2rem] overflow-hidden border border-white/5 shadow-xl transition-all duration-500 hover:-translate-y-2 hover:border-white/10">
                            <div class="w-full h-48 overflow-hidden relative bg-[#1e222b]">
                                <img src="{{ asset('storage/'.$rel->image) }}" class="w-full h-full object-cover transform scale-100 group-hover:scale-105 transition-transform duration-700 ease-out" alt="{{ $rel->name }}">
                            </div>
                            <div class="p-5 space-y-2">
                                <h3 class="font-bold text-white group-hover:text-brand transition-colors line-clamp-1">{{ $rel->name }}</h3>
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-brand">${{ number_format($rel->price, 2) }}</span>
                                    <span class="text-xs text-gray-500">{{ $rel->category->name }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection