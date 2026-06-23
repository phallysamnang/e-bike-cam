@extends('layouts.app')

@section('content')
<div class="pt-32 pb-16 bg-[#0f1115] min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
        <a href="{{ route('product.show', $product) }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-brand transition-colors mb-8 text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            Back to {{ $product->name }}
        </a>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
            <div class="md:col-span-2">
                <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-6 sticky top-28">
                    <div class="w-full aspect-square rounded-xl overflow-hidden bg-[#1e222b] mb-4">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-bold text-white text-lg">{{ $product->name }}</h3>
                    <p class="text-xs text-gray-500">{{ $product->category->name }}</p>
                    <p class="text-3xl font-black text-brand mt-3">${{ number_format($product->price, 2) }}</p>

                    <div class="mt-4 pt-4 border-t border-white/5 space-y-2 text-sm text-gray-400">
                        @if($product->battery_range)
                            <div class="flex justify-between">            <span>{{ __('Battery Range') }}</span><span class="text-white font-medium">{{ $product->battery_range }}</span></div>
                        @endif
                        @if($product->top_speed)
                            <div class="flex justify-between">            <span>{{ __('Top Speed') }}</span><span class="text-white font-medium">{{ $product->top_speed }}</span></div>
                        @endif
                        <div class="flex justify-between">
                            <span>{{ __('Available Stock') }}</span>
                            <span class="font-medium {{ $product->stock > 5 ? 'text-white' : ($product->stock > 0 ? 'text-yellow-400' : 'text-red-400') }}">{{ $product->stock }} {{ __('Units') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-3">
                <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
                    <h2 class="text-2xl font-black text-white tracking-tight mb-2">{{ __('Place Your Order') }}</h2>
                    <p class="text-sm text-gray-400 mb-8">{{ __('Fill in your details and we\'ll get back to you within 24 hours.') }}</p>

                    <form action="{{ route('order.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Full Name') }}</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand" required>
                            @error('customer_name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Email') }}</label>
                                <input type="email" name="customer_email" value="{{ old('customer_email', auth()->user()->email ?? '') }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand" required>
                                @error('customer_email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Phone') }} <span class="text-gray-500 font-normal">({{ __('optional') }})</span></label>
                                <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Delivery Address') }}</label>
                            <textarea name="customer_address" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand" required>{{ old('customer_address') }}</textarea>
                            @error('customer_address') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Quantity') }}</label>
                                <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="99" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand">
                                @error('quantity') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Total') }}</label>
                                <div class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white font-bold text-lg" id="totalDisplay">${{ number_format($product->price, 2) }}</div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Notes') }} <span class="text-gray-500 font-normal">({{ __('optional') }})</span></label>
                            <textarea name="notes" rows="2" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand" placeholder="{{ __('Any special requests...') }}">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-brand text-darkbg font-bold px-8 py-4 rounded-xl hover:bg-brand/90 transition-all text-lg flex items-center justify-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            {{ __('Place Order') }} — ${{ number_format($product->price, 2) }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const price = {{ $product->price }};
    const maxStock = {{ $product->stock }};
    const qtyInput = document.querySelector('input[name="quantity"]');
    const totalDisplay = document.getElementById('totalDisplay');
    const submitBtn = document.querySelector('button[type="submit"]');

    qtyInput.setAttribute('max', maxStock);

    qtyInput.addEventListener('input', function() {
        let qty = parseInt(this.value) || 1;
        if (qty > maxStock) {
            qty = maxStock;
            this.value = maxStock;
        }
        if (qty < 1) {
            qty = 1;
            this.value = 1;
        }
        const total = (price * qty).toFixed(2);
        totalDisplay.textContent = '$' + total;
        submitBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> {{ __('Place Order') }} — $' + total;
    });
</script>
@endsection
