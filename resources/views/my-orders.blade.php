@extends('layouts.app')

@section('content')
<div class="pt-32 pb-16 bg-[#0f1115] min-h-screen">
    <div class="max-w-5xl mx-auto px-6">
        <div class="mb-10">
            <h1 class="text-4xl font-extrabold text-white tracking-tight">{{ __('My Orders') }}</h1>
            <p class="text-gray-400 mt-2 font-light">{{ __('Track and review your orders') }}</p>
        </div>

        @if(session('success'))
            <div class="bg-brand/10 border border-brand/20 text-brand font-semibold px-6 py-4 rounded-2xl text-sm flex items-center gap-3 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                {{ session('success') }}
            </div>
        @endif

        @forelse($orders as $order)
            <div class="bg-[#161920] border border-white/5 rounded-[2rem] overflow-hidden mb-4 transition-all hover:border-white/10">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('storage/' . $order->product->image) }}" class="w-16 h-12 object-cover rounded-xl border border-white/5">
                            <div>
                                <h3 class="font-bold text-white">{{ $order->product->name }}</h3>
                                <p class="text-xs text-gray-500">{{ __('Qty') }}: {{ $order->quantity }} &middot; ${{ number_format($order->total_price, 2) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-500/10 text-yellow-400',
                                    'confirmed' => 'bg-blue-500/10 text-blue-400',
                                    'shipped' => 'bg-purple-500/10 text-purple-400',
                                    'delivered' => 'bg-brand/10 text-brand',
                                    'completed' => 'bg-brand/20 text-brand',
                                    'cancelled' => 'bg-red-500/10 text-red-400',
                                ];
                                $statusIcons = [
                                    'pending' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                                    'confirmed' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                                    'shipped' => 'M13 10V3L4 14h7v7l9-11h-7z',
                                    'delivered' => 'M5 13l4 4L19 7',
                                    'completed' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                                    'cancelled' => 'M6 18L18 6M6 6l12 12',
                                ];
                                $color = $statusColors[$order->status] ?? 'bg-gray-500/10 text-gray-400';
                                $icon = $statusIcons[$order->status] ?? '';
                            @endphp
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full {{ $color }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}" /></svg>
                                {{ __($order->status) }}
                            </span>
                            @if($order->status !== 'cancelled')
                                @if($order->payment_status === 'unpaid')
                                    <a href="{{ route('payment.show', $order) }}" class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider px-4 py-2 bg-brand text-darkbg rounded-full hover:bg-brand/90 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                        {{ __('Pay Now') }}
                                    </a>
                                @elseif($order->payment_status === 'pending_confirmation')
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full bg-yellow-500/10 text-yellow-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        {{ __('Payment Pending') }}
                                    </span>
                                @elseif($order->payment_status === 'paid')
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full bg-brand/20 text-brand">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        {{ __('Paid') }}
                                    </span>
                                @endif
                            @endif
                            @if(in_array($order->status, ['pending', 'confirmed']))
                                <form action="{{ route('orders.cancel', $order) }}" method="POST" onsubmit="return confirm('{{ __('Cancel this order?') }}')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider px-4 py-2 bg-red-500/10 text-red-400 rounded-full hover:bg-red-500/20 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                        {{ __('Cancel') }}
                                    </button>
                                </form>
                            @endif
                            @if($order->status === 'delivered')
                                <form action="{{ route('orders.accept', $order) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider px-4 py-2 bg-brand text-darkbg rounded-full hover:bg-brand/90 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                        {{ __('Accept') }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-x-6 gap-y-1 text-xs text-gray-500">
                        <span>{{ __('Order #') }}{{ $order->id }}</span>
                        <span>{{ $order->created_at->format('d M Y, g:i A') }}</span>
                        <span>{{ $order->customer_address }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-20">
                <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" /></svg>
                </div>
                <p class="text-gray-500 font-medium">{{ __('No orders yet') }}</p>
                <a href="/#bikes" class="inline-flex items-center gap-2 mt-4 text-brand hover:text-brand/80 transition-colors text-sm font-medium">
                    {{ __('Browse E-Bikes') }} &rarr;
                </a>
            </div>
        @endforelse

        @if($orders->hasPages())
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
