<x-admin-layout>
    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Orders') }}</h1>
                <p class="text-sm text-gray-400 mt-1">{{ __('Manage customer orders') }}</p>
            </div>
        </div>

        <div class="flex flex-wrap gap-2 mb-4">
            <a href="{{ route('admin.orders.index', array_merge(request()->except(['from_date', 'to_date', 'page']), ['from_date' => now()->format('Y-m-d'), 'to_date' => now()->format('Y-m-d')])) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold {{ request('from_date') === now()->format('Y-m-d') ? 'bg-brand text-darkbg' : 'bg-white/5 text-gray-400 hover:bg-white/10' }} transition-all">{{ __('Today') }}</a>
            <a href="{{ route('admin.orders.index', array_merge(request()->except(['from_date', 'to_date', 'page']), ['from_date' => now()->startOfWeek()->format('Y-m-d'), 'to_date' => now()->format('Y-m-d')])) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold {{ request('from_date') === now()->startOfWeek()->format('Y-m-d') ? 'bg-brand text-darkbg' : 'bg-white/5 text-gray-400 hover:bg-white/10' }} transition-all">{{ __('This Week') }}</a>
            <a href="{{ route('admin.orders.index', array_merge(request()->except(['from_date', 'to_date', 'page']), ['from_date' => now()->startOfMonth()->format('Y-m-d'), 'to_date' => now()->format('Y-m-d')])) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold {{ request('from_date') === now()->startOfMonth()->format('Y-m-d') ? 'bg-brand text-darkbg' : 'bg-white/5 text-gray-400 hover:bg-white/10' }} transition-all">{{ __('This Month') }}</a>
            <a href="{{ route('admin.orders.index', request()->except(['from_date', 'to_date', 'status', 'page'])) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold {{ !request('from_date') && !request('status') ? 'bg-brand text-darkbg' : 'bg-white/5 text-gray-400 hover:bg-white/10' }} transition-all">{{ __('All Orders') }}</a>
        </div>

        <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-6 p-4 bg-white/[0.02] border border-white/5 rounded-2xl">
            <div class="flex flex-wrap items-end gap-3">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1.5">{{ __('From') }}</label>
                    <input type="date" name="from_date" value="{{ request('from_date') }}" class="bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:outline-none focus:border-brand">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1.5">{{ __('To') }}</label>
                    <input type="date" name="to_date" value="{{ request('to_date') }}" class="bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:outline-none focus:border-brand">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1.5">{{ __('Status') }}</label>
                    <select name="status" class="bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:outline-none focus:border-brand">
                        <option value="" class="bg-darkbg">{{ __('All') }}</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }} class="bg-darkbg">{{ __('Pending') }}</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }} class="bg-darkbg">{{ __('Confirmed') }}</option>
                        <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }} class="bg-darkbg">{{ __('Shipped') }}</option>
                        <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }} class="bg-darkbg">{{ __('Delivered') }}</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }} class="bg-darkbg">{{ __('Completed') }}</option>
                                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }} class="bg-darkbg">{{ __('Cancelled') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1.5">{{ __('Payment') }}</label>
                            <select name="payment_status" class="bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:outline-none focus:border-brand">
                                <option value="" class="bg-darkbg">{{ __('All') }}</option>
                                <option value="unpaid" {{ request('payment_status') === 'unpaid' ? 'selected' : '' }} class="bg-darkbg">{{ __('Unpaid') }}</option>
                                <option value="pending_confirmation" {{ request('payment_status') === 'pending_confirmation' ? 'selected' : '' }} class="bg-darkbg">{{ __('Pending Confirmation') }}</option>
                                <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }} class="bg-darkbg">{{ __('Paid') }}</option>
                            </select>
                        </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-brand text-darkbg font-bold px-5 py-2 rounded-xl text-xs hover:bg-brand/90 transition-all">{{ __('Filter') }}</button>
                    <a href="{{ route('admin.orders.index') }}" class="bg-white/5 text-gray-300 font-semibold px-5 py-2 rounded-xl text-xs hover:bg-white/10 transition-all">{{ __('Reset') }}</a>
                </div>
            </div>
        </form>

        <div class="mb-4 flex items-center gap-2 text-sm">
            <span class="text-gray-400">{{ __('Showing') }}</span>
            <span class="font-bold text-white">{{ $orders->firstItem() ?? 0 }}</span>
            <span class="text-gray-400">-</span>
            <span class="font-bold text-white">{{ $orders->lastItem() ?? 0 }}</span>
            <span class="text-gray-400">{{ __('of') }}</span>
            <span class="font-bold text-brand">{{ $orders->total() }}</span>
            <span class="text-gray-400">{{ __('orders') }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5 text-left">
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Order') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Customer') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Product') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Total') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Status') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Payment') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500">{{ __('Date') }}</th>
                        <th class="pb-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                            <td class="py-4 pr-4">
                                <span class="font-mono text-xs text-gray-400">#{{ $order->id }}</span>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="font-semibold text-white">{{ $order->customer_name }}</span>
                                <p class="text-xs text-gray-500">{{ $order->customer_email }}</p>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="text-sm text-white">{{ $order->product->name }}</span>
                                <p class="text-xs text-gray-500">x{{ $order->quantity }}</p>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="font-bold text-white">${{ number_format($order->total_price, 2) }}</span>
                            </td>
                            <td class="py-4 pr-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-500/10 text-yellow-400',
                                        'confirmed' => 'bg-blue-500/10 text-blue-400',
                                        'shipped' => 'bg-purple-500/10 text-purple-400',
                                        'delivered' => 'bg-brand/10 text-brand',
                                        'completed' => 'bg-brand/20 text-brand',
                                        'cancelled' => 'bg-red-500/10 text-red-400',
                                    ];
                                    $color = $statusColors[$order->status] ?? 'bg-gray-500/10 text-gray-400';
                                @endphp
                                <span class="text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full {{ $color }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="py-4 pr-4">
                                @php
                                    $paymentColors = [
                                        'unpaid' => 'bg-gray-500/10 text-gray-400',
                                        'pending_confirmation' => 'bg-yellow-500/10 text-yellow-400',
                                        'paid' => 'bg-brand/10 text-brand',
                                    ];
                                    $paymentColor = $paymentColors[$order->payment_status] ?? 'bg-gray-500/10 text-gray-400';
                                @endphp
                                <span class="text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full {{ $paymentColor }}">
                                    {{ str_replace('_', ' ', $order->payment_status) }}
                                </span>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="text-sm text-gray-400">{{ $order->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="py-4">
                                <div class="flex justify-center">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="px-4 py-2 bg-blue-500/10 text-blue-400 rounded-xl text-xs font-bold hover:bg-blue-500/20 transition-colors">{{ __('View') }}</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" /></svg>
                                    </div>
                                    <p class="text-gray-500 font-medium">{{ __('No orders yet') }}</p>
                                    <p class="text-gray-600 text-sm mt-1">{{ __('Customer orders will appear here') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
