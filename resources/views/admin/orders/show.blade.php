<x-admin-layout>
    <div class="space-y-6">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-brand transition-colors text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            {{ __('Back to Orders') }}
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Order #') }}{{ $order->id }}</h1>
                            <p class="text-sm text-gray-400 mt-1">{{ __('Placed on') }} {{ $order->created_at->format('F d, Y') }} {{ __('at') }} {{ $order->created_at->format('g:i A') }}</p>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full {{ match($order->status) { 'pending' => 'bg-yellow-500/10 text-yellow-400', 'confirmed' => 'bg-blue-500/10 text-blue-400', 'shipped' => 'bg-purple-500/10 text-purple-400', 'delivered' => 'bg-brand/10 text-brand', 'completed' => 'bg-brand/20 text-brand', 'cancelled' => 'bg-red-500/10 text-red-400', default => 'bg-gray-500/10 text-gray-400' } }}">
                            {{ $order->status }}
                        </span>
                    </div>

                    <div class="bg-white/[0.02] rounded-2xl p-6 border border-white/5">
                        <div class="flex gap-6">
                            <img src="{{ asset('storage/' . $order->product->image) }}" class="w-24 h-20 object-cover rounded-xl border border-white/5">
                            <div class="flex-1">
                                <h3 class="font-bold text-white text-lg">{{ $order->product->name }}</h3>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $order->product->category->name }}</p>
                                <div class="flex justify-between items-end mt-4">
                                    <div>
                                        <p class="text-sm text-gray-400">{{ __('Qty') }}: <span class="font-bold text-white">{{ $order->quantity }}</span></p>
                                        <p class="text-sm text-gray-400">{{ __('Unit Price') }}: <span class="font-bold text-white">${{ number_format($order->product->price, 2) }}</span></p>
                                    </div>
                                    <p class="text-2xl font-black text-brand">${{ number_format($order->total_price, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($order->notes)
                        <div class="mt-6">
                            <h4 class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">{{ __('Order Notes') }}</h4>
                            <p class="text-sm text-gray-300 bg-white/[0.02] rounded-xl p-4 border border-white/5">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
                    <h4 class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-4">{{ __('Customer Details') }}</h4>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500">{{ __('Name') }}</p>
                            <p class="font-semibold text-white">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">{{ __('Email') }}</p>
                            <p class="font-semibold text-white">{{ $order->customer_email }}</p>
                        </div>
                        @if($order->customer_phone)
                            <div>
                                <p class="text-xs text-gray-500">{{ __('Phone') }}</p>
                                <p class="font-semibold text-white">{{ $order->customer_phone }}</p>
                            </div>
                        @endif
                        <div>
                            <p class="text-xs text-gray-500">{{ __('Address') }}</p>
                            <p class="font-semibold text-white text-sm">{{ $order->customer_address }}</p>
                        </div>
                        @if($order->user)
                            <div class="pt-2 border-t border-white/5">
                                <p class="text-xs text-gray-500">{{ __('Registered User') }}</p>
                                <p class="font-semibold text-brand text-sm">{{ $order->user->name }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                @can('update-orders')
                    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
                        <h4 class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-4">{{ __('Update Status') }}</h4>
                        <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="space-y-3">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-brand text-sm">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }} class="bg-darkbg">{{ __('Pending') }}</option>
                                <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }} class="bg-darkbg">{{ __('Confirmed') }}</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }} class="bg-darkbg">{{ __('Shipped') }}</option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }} class="bg-darkbg">{{ __('Delivered') }}</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }} class="bg-darkbg">{{ __('Cancelled') }}</option>
                            </select>
                            <button type="submit" class="w-full bg-brand text-darkbg font-bold py-3 rounded-xl text-sm hover:bg-brand/90 transition-all">{{ __('Update Status') }}</button>
                        </form>
                    </div>
                @endcan

                @if($order->payment_status === 'pending_confirmation')
                    <div class="bg-yellow-500/10 border border-yellow-500/20 rounded-[2rem] p-8">
                        <h4 class="text-xs font-bold uppercase tracking-widest text-yellow-400 mb-4">{{ __('Payment Confirmation') }}</h4>
                        <p class="text-sm text-gray-300 mb-3">{{ __('This customer has submitted payment proof and is awaiting verification.') }}</p>
                        <div class="space-y-2 text-sm text-gray-400 mb-4">
                            <p><span class="text-gray-500">{{ __('Method') }}:</span> <span class="text-white font-medium capitalize">{{ $order->payment_method }}</span></p>
                            @if($order->payment_notes)
                                <p><span class="text-gray-500">{{ __('Notes') }}:</span> <span class="text-white">{{ $order->payment_notes }}</span></p>
                            @endif
                        </div>
                        @if($order->payment_proof)
                            <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-brand hover:text-brand/80 transition-colors mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                {{ __('View Payment Proof') }}
                            </a>
                        @endif
                        <form action="{{ route('admin.orders.confirm-payment', $order) }}" method="POST" class="space-y-2">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full bg-brand text-darkbg font-bold py-3 rounded-xl text-sm hover:bg-brand/90 transition-all">
                                {{ __('Confirm Payment') }}
                            </button>
                        </form>
                    </div>
                @elseif($order->payment_status === 'paid')
                    <div class="bg-brand/10 border border-brand/20 rounded-[2rem] p-8">
                        <h4 class="text-xs font-bold uppercase tracking-widest text-brand mb-4">{{ __('Payment') }}</h4>
                        <div class="space-y-2 text-sm">
                            <p class="text-gray-400"><span class="text-gray-500">{{ __('Status') }}:</span> <span class="text-brand font-bold">{{ __('Paid') }}</span></p>
                            <p class="text-gray-400"><span class="text-gray-500">{{ __('Method') }}:</span> <span class="text-white font-medium capitalize">{{ $order->payment_method }}</span></p>
                            @if($order->paid_at)
                                <p class="text-gray-400"><span class="text-gray-500">{{ __('Paid at') }}:</span> <span class="text-white">{{ $order->paid_at->format('d M Y, g:i A') }}</span></p>
                            @endif
                            @if($order->payment_proof)
                                <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-brand hover:text-brand/80 transition-colors mt-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    {{ __('View Receipt') }}
                                </a>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
                        <h4 class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-4">{{ __('Payment') }}</h4>
                        <p class="text-sm text-gray-500">{{ __('No payment yet') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
