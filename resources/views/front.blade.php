@extends('layouts.app')

@section('content')

<div class="slider-wrapper">
    <div class="slides" id="slider">
        @foreach ($slides as $slide)
            <div class="slide">
                <img src="{{ asset('storage/' . $slide->image) }}" alt="Electric Bike">
                <div class="overlay"></div>

                <div class="content space-y-4">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium bg-brand/10 text-brand tracking-wider uppercase border border-brand/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand animate-pulse"></span> {{ __('Next Gen E-Bikes') }}
                        </span>
                    <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight leading-none">{{ $slide->title }}</h1>
                    <p class="text-lg text-gray-400 max-w-xl font-light leading-relaxed">
                        {{ __('Premium engineering paired with innovative clean energy tech to rewrite your city commute.') }}
                    </p>
                    <div class="pt-4">
                        <a href="#bikes" class="inline-flex items-center justify-center px-6 py-3.5 bg-brand hover:bg-brand/90 text-darkbg font-bold rounded-xl shadow-lg shadow-brand/20 transition-all duration-300 hover:-translate-y-0.5">
                            {{ __('Discover Features') }}
                        </a>
                    </div>
                    </div>
                </div>
            @endforeach
        </div>

    <div class="absolute bottom-12 right-8 md:right-16 z-20 flex gap-3">
        @foreach ($slides as $index => $s)
            <div class="w-12 h-1 bg-white/20 rounded-full overflow-hidden">
                <div class="h-full bg-white transition-all duration-[4000ms] ease-linear w-0" id="progress-bar-{{ $index }}"></div>
            </div>
        @endforeach
    </div>
</div>

<div id="categories" class="py-32 bg-[#0f1115] relative overflow-hidden">
    <div class="absolute top-1/4 left-1/4 -translate-x-1/2 w-96 h-96 bg-brand/5 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-4">
            <div>
                <span class="text-xs font-bold tracking-widest text-brand uppercase block mb-3">{{ __('Curated Collections') }}</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">
                    {{ __('Shop By Category') }}
                </h2>
            </div>
            <p class="text-gray-400 max-w-md font-light leading-relaxed">
                {{ __('Engineered variants optimized for performance output, urban versatility, and off-road exploration.') }}
            </p>
        </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <a href="{{ route('category.show', $category) }}" class="group bg-[#161920] border border-white/5 rounded-[2rem] p-10 text-center shadow-xl transition-all duration-500 hover:border-brand/30 hover:shadow-brand/5 hover:-translate-y-1">
                    <div class="w-16 h-16 rounded-2xl bg-brand/10 flex items-center justify-center mx-auto mb-6 group-hover:bg-brand group-hover:text-darkbg transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-brand group-hover:text-darkbg transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white tracking-tight group-hover:text-brand transition-colors">{{ $category->name }}</h3>
                    <span class="text-sm text-gray-500 mt-2 block font-medium">{{ __('Browse Collection') }} &rarr;</span>
                </a>
            @endforeach
        </div>
    </div>
</div>

<div id="bikes" class="py-32 bg-[#13161c] border-t border-white/5 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-xl mx-auto mb-16">
            <span class="text-xs font-bold tracking-widest text-brand uppercase block mb-3">{{ __('Premium Performance') }}</span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">
                {{ __('Featured Bikes') }}
            </h2>
            <p class="text-gray-400 mt-4 font-light">
                {{ __('Discover your perfect custom configuration built with leading industry drive trains and modern design.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="group bg-[#161920] rounded-[2rem] overflow-hidden border border-white/5 shadow-xl transition-all duration-500 hover:-translate-y-2 hover:border-white/10 hover:shadow-2xl">
                    <div class="w-full h-64 overflow-hidden relative bg-[#1e222b]">
                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            class="w-full h-full object-cover transform scale-100 group-hover:scale-105 transition-transform duration-700 ease-out"
                            alt="{{ $product->name }}"
                        >
                        <span class="absolute top-4 left-4 text-[11px] font-semibold tracking-wider uppercase px-3 py-1 bg-[#0f1115]/80 backdrop-blur-md text-gray-300 rounded-full border border-white/5">
                            {{ $product->category->name }}
                        </span>
                    </div>

                    <div class="p-6 space-y-4">
                        <div>
                            <h3 class="font-bold text-lg text-white tracking-tight group-hover:text-brand transition-colors line-clamp-1">
                                {{ $product->name }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-1 font-medium">{{ __('Available Edition') }}</p>
                        </div>

                        <div class="flex justify-between items-center pt-2 border-t border-white/5">
                            <div class="flex flex-col">
                                <span class="text-2xl font-bold text-white tracking-tight">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </div>

                            <a href="{{ route('product.show', $product) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white/5 hover:bg-brand text-sm font-medium text-white hover:text-darkbg rounded-xl border border-white/10 hover:border-brand shadow-sm transition-all duration-300">
                                {{ __('View') }}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    let index = 0;
    const slider = document.getElementById("slider");
    const totalSlides = parseInt("{{ $slides->count() }}", 10);

    function nextSlide() {
        index++;

        if (index >= totalSlides) {
            index = 0;
        }

        if(slider) {
            slider.style.transform = "translateX(-" + (index * 100) + "%)";
        }
    }

    if (totalSlides > 0) {
        setInterval(nextSlide, 4000);
    }
</script>

@endsection