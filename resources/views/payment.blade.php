@extends('layouts.app')

@section('content')
<div class="pt-32 pb-16 bg-[#0f1115] min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
        <a href="{{ route('orders.my') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-brand transition-colors mb-8 text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            {{ __('Back to My Orders') }}
        </a>

        @if($order->payment_status === 'paid')
            <div class="bg-brand/10 border border-brand/20 text-brand font-semibold px-6 py-4 rounded-2xl text-sm flex items-center gap-3 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                {{ __('This order has been paid. Thank you!') }}
            </div>
        @elseif($order->payment_status === 'pending_confirmation')
            <div class="bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 font-semibold px-6 py-4 rounded-2xl text-sm flex items-center gap-3 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                {{ __('Your payment proof is awaiting admin confirmation. We will notify you once verified.') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
            <div class="md:col-span-2">
                <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-6 sticky top-28">
                    <div class="w-full aspect-square rounded-xl overflow-hidden bg-[#1e222b] mb-4">
                        <img src="{{ asset('storage/' . $order->product->image) }}" class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-bold text-white text-lg">{{ $order->product->name }}</h3>
                    <p class="text-xs text-gray-500">{{ __('Qty') }}: {{ $order->quantity }}</p>
                    <p class="text-3xl font-black text-brand mt-3">${{ number_format($order->total_price, 2) }}</p>

                    <div class="mt-4 pt-4 border-t border-white/5 space-y-2 text-sm text-gray-400">
                        <div class="flex justify-between">
                            <span>{{ __('Order') }} #{{ $order->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>{{ __('Status') }}</span>
                            <span class="text-white font-medium capitalize">{{ str_replace('_', ' ', $order->payment_status) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-3 space-y-6">
                @if($order->payment_status !== 'paid')
                <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
                    <h2 class="text-2xl font-black text-white tracking-tight mb-2">{{ __('Bank Transfer') }}</h2>
                    <p class="text-sm text-gray-400 mb-6">{{ __('Transfer the exact amount to one of our accounts below and upload the proof.') }}</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div class="bg-white/5 rounded-2xl p-5 border border-white/5">
                            <div class="w-full aspect-square rounded-xl bg-white/10 flex items-center justify-center mb-3 overflow-hidden">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=ABA%20Bank%20-%20VOLT%20Electric%20Bike%20-%20Account%3A%20001012345" class="w-full h-full object-cover" alt="ABA QR">
                            </div>
                            <h4 class="font-bold text-white text-sm">{{ __('ABA Bank') }}</h4>
                            <p class="text-xs text-gray-400 mt-1">{{ __('Account') }}: <span class="text-white font-mono">001 012 345</span></p>
                            <p class="text-xs text-gray-400">{{ __('Name') }}: VOLT Electric Bike</p>
                        </div>
                        <div class="bg-white/5 rounded-2xl p-5 border border-white/5">
                            <div class="w-full aspect-square rounded-xl bg-white/10 flex items-center justify-center mb-3 overflow-hidden">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=ACLEDA%20Bank%20-%20VOLT%20Electric%20Bike%20-%20Account%3A%20000345678" class="w-full h-full object-cover" alt="ACLEDA QR">
                            </div>
                            <h4 class="font-bold text-white text-sm">{{ __('ACLEDA Bank') }}</h4>
                            <p class="text-xs text-gray-400 mt-1">{{ __('Account') }}: <span class="text-white font-mono">000 345 678</span></p>
                            <p class="text-xs text-gray-400">{{ __('Name') }}: VOLT Electric Bike</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-white/5 rounded-2xl p-5 border border-white/5">
                            <div class="w-full aspect-square rounded-xl bg-white/10 flex items-center justify-center mb-3 overflow-hidden">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=Wing%20Bank%20-%20VOLT%20Electric%20Bike%20-%20069%20888%20999" class="w-full h-full object-cover" alt="Wing QR">
                            </div>
                            <h4 class="font-bold text-white text-sm">{{ __('Wing') }}</h4>
                            <p class="text-xs text-gray-400 mt-1">{{ __('Phone') }}: <span class="text-white font-mono">069 888 999</span></p>
                            <p class="text-xs text-gray-400">{{ __('Name') }}: VOLT Electric Bike</p>
                        </div>
                        <div class="bg-white/5 rounded-2xl p-5 border border-white/5">
                            <div class="w-full aspect-square rounded-xl bg-white/10 flex items-center justify-center mb-3 overflow-hidden">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=VOLT%20Electric%20Bike%20-%20Bank%20Transfer" class="w-full h-full object-cover" alt="Bank QR">
                            </div>
                            <h4 class="font-bold text-white text-sm">{{ __('Other Banks') }}</h4>
                            <p class="text-xs text-gray-400 mt-1">{{ __('Contact us for other options') }}</p>
                        </div>
                    </div>

                    <div class="bg-brand/5 border border-brand/10 rounded-2xl p-4 text-sm">
                        <p class="text-brand font-bold mb-1">{{ __('Amount to Pay: $') }}{{ number_format($order->total_price, 2) }}</p>
                        <p class="text-gray-400 text-xs">{{ __('Please include your Order #') }}{{ $order->id }} {{ __('in the transfer description.') }}</p>
                    </div>
                </div>

                <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
                    <h2 class="text-2xl font-black text-white tracking-tight mb-2">{{ __('Upload Payment Proof') }}</h2>
                    <p class="text-sm text-gray-400 mb-6">{{ __('After transferring, upload a screenshot or photo of the receipt.') }}</p>

                    <form action="{{ route('payment.upload', $order) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Payment Method') }}</label>
                            <select name="payment_method" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand" required>
                                <option value="" class="bg-darkbg">{{ __('Select payment method') }}</option>
                                <option value="aba" class="bg-darkbg">ABA Bank</option>
                                <option value="acleda" class="bg-darkbg">ACLEDA Bank</option>
                                <option value="wing" class="bg-darkbg">Wing</option>
                                <option value="bank_transfer" class="bg-darkbg">{{ __('Other Bank Transfer') }}</option>
                            </select>
                            @error('payment_method') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Payment Receipt / Screenshot') }}</label>
                            <div class="relative">
                                <input type="file" name="payment_proof" accept="image/jpeg,image/png,image/jpg,image/gif" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand file:text-darkbg hover:file:bg-brand/90 focus:outline-none focus:border-brand" required>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">{{ __('Accepted: JPEG, PNG, JPG, GIF. Max 5MB.') }}</p>
                            @error('payment_proof') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">{{ __('Notes') }} <span class="text-gray-500 font-normal">({{ __('optional') }})</span></label>
                            <textarea name="payment_notes" rows="2" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand" placeholder="{{ __('Transfer reference or any notes...') }}">{{ old('payment_notes') }}</textarea>
                            @error('payment_notes') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="w-full bg-brand text-darkbg font-bold px-8 py-4 rounded-xl hover:bg-brand/90 transition-all text-lg flex items-center justify-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ __('Submit Payment Proof') }}
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
