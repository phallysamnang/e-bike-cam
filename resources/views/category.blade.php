@extends('layouts.app')

@section('content')
<div class="pt-32 pb-16 bg-[#0f1115] min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        <a href="/#categories" class="inline-flex items-center gap-2 text-gray-400 hover:text-brand transition-colors mb-8 text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            {{ __('Back to Categories') }}
        </a>

        <div class="mb-12">
            <span class="text-xs font-bold tracking-widest text-brand uppercase block mb-3">{{ __('Category') }}</span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">{{ $category->name }}</h1>
            <p class="text-gray-400 mt-2 font-light">{{ $products->total() }} {{ __('Models Available') }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                <a href="{{ route('product.show', $product) }}" class="group bg-[#161920] rounded-[2rem] overflow-hidden border border-white/5 shadow-xl transition-all duration-500 hover:-translate-y-2 hover:border-white/10 hover:shadow-2xl">
                    <div class="w-full h-56 overflow-hidden relative bg-[#1e222b]">
                        <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-full object-cover transform scale-100 group-hover:scale-105 transition-transform duration-700 ease-out" alt="{{ $product->name }}">
                        @if($product->featured)
                            <span class="absolute top-3 left-3 text-[10px] font-bold uppercase px-2 py-1 bg-brand text-darkbg rounded-full">{{ __('Featured') }}</span>
                        @endif
                    </div>
                    <div class="p-5 space-y-3">
                        <h3 class="font-bold text-lg text-white group-hover:text-brand transition-colors line-clamp-1">{{ $product->name }}</h3>
                        <div class="flex justify-between items-end">
                            <span class="text-2xl font-bold text-white">${{ number_format($product->price, 2) }}</span>
                            <span class="text-xs text-gray-500 font-medium">{{ $product->battery_range ?? '' }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    </div>
                    <p class="text-gray-500 font-medium">{{ __('No products in this category yet') }}</p>
                </div>
            @endforelse
        </div>

        @if($products->hasPages())
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection