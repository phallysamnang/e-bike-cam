<x-admin-layout>
    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-white tracking-tight">{{ __('Reports') }}</h1>
                <p class="text-sm text-gray-400 mt-1">{{ __('Sales and order analytics') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-brand bg-brand/10 px-4 py-2 rounded-xl border border-brand/20">{{ $currentPeriodName }}</span>
                <a href="{{ route('admin.reports.export', request()->query()) }}" class="inline-flex items-center gap-2 bg-brand text-darkbg font-bold px-4 py-2 rounded-xl text-xs hover:bg-brand/90 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    {{ __('Export Excel') }}
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-6">
        <div class="flex flex-wrap gap-2 mb-2">
            <a href="{{ route('admin.reports.index', ['period' => 'today']) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold {{ $period === 'today' ? 'bg-brand text-darkbg' : 'bg-white/5 text-gray-400 hover:bg-white/10' }} transition-all">{{ __('Today') }}</a>
            <a href="{{ route('admin.reports.index', ['period' => 'yesterday']) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold {{ $period === 'yesterday' ? 'bg-brand text-darkbg' : 'bg-white/5 text-gray-400 hover:bg-white/10' }} transition-all">{{ __('Yesterday') }}</a>
            <a href="{{ route('admin.reports.index', ['period' => 'this_week']) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold {{ $period === 'this_week' ? 'bg-brand text-darkbg' : 'bg-white/5 text-gray-400 hover:bg-white/10' }} transition-all">{{ __('This Week') }}</a>
            <a href="{{ route('admin.reports.index', ['period' => 'last_week']) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold {{ $period === 'last_week' ? 'bg-brand text-darkbg' : 'bg-white/5 text-gray-400 hover:bg-white/10' }} transition-all">{{ __('Last Week') }}</a>
            <a href="{{ route('admin.reports.index', ['period' => 'this_month']) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold {{ $period === 'this_month' ? 'bg-brand text-darkbg' : 'bg-white/5 text-gray-400 hover:bg-white/10' }} transition-all">{{ __('This Month') }}</a>
            <a href="{{ route('admin.reports.index', ['period' => 'last_month']) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold {{ $period === 'last_month' ? 'bg-brand text-darkbg' : 'bg-white/5 text-gray-400 hover:bg-white/10' }} transition-all">{{ __('Last Month') }}</a>
            <a href="{{ route('admin.reports.index', ['period' => 'this_year']) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold {{ $period === 'this_year' ? 'bg-brand text-darkbg' : 'bg-white/5 text-gray-400 hover:bg-white/10' }} transition-all">{{ __('This Year') }}</a>
            <a href="{{ route('admin.reports.index', ['period' => 'last_year']) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold {{ $period === 'last_year' ? 'bg-brand text-darkbg' : 'bg-white/5 text-gray-400 hover:bg-white/10' }} transition-all">{{ __('Last Year') }}</a>
            <a href="{{ route('admin.reports.index') }}" class="px-4 py-1.5 rounded-xl text-xs font-bold {{ $period === 'all_time' ? 'bg-brand text-darkbg' : 'bg-white/5 text-gray-400 hover:bg-white/10' }} transition-all">{{ __('All Time') }}</a>
        </div>

        <form method="GET" action="{{ route('admin.reports.index') }}" class="flex flex-wrap items-end gap-3 pt-3 border-t border-white/5 mt-3">
            <input type="hidden" name="period" value="custom">
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1.5">{{ __('From') }}</label>
                <input type="date" name="from_date" value="{{ request('from_date', $period === 'custom' ? $fromDate->format('Y-m-d') : '') }}" class="bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:outline-none focus:border-brand">
            </div>
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1.5">{{ __('To') }}</label>
                <input type="date" name="to_date" value="{{ request('to_date', $period === 'custom' ? $toDate->format('Y-m-d') : '') }}" class="bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:outline-none focus:border-brand">
            </div>
            <button type="submit" class="bg-brand text-darkbg font-bold px-5 py-2 rounded-xl text-xs hover:bg-brand/90 transition-all">{{ __('Apply') }}</button>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-6">
            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">{{ __('Total Orders') }}</p>
            <p class="text-3xl font-black text-white mt-1">{{ $totalOrders }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ $fromDate->format('M d, Y') }} - {{ $toDate->format('M d, Y') }}</p>
        </div>
        <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-6">
            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">{{ __('Total Revenue') }}</p>
            <p class="text-3xl font-black text-brand mt-1">${{ number_format($totalRevenue, 2) }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ __('Paid orders') }}</p>
        </div>
        <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-6">
            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">{{ __('Products Sold') }}</p>
            <p class="text-3xl font-black text-white mt-1">{{ $totalProductsSold }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ __('Total units') }}</p>
        </div>
        <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-6">
            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">{{ __('Avg Order Value') }}</p>
            <p class="text-3xl font-black text-white mt-1">${{ number_format($avgOrderValue, 2) }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ __('Per order') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
            <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-6">{{ __('Revenue Chart') }}</h3>
            @if(count($revenueChart['labels']) > 0 && max($revenueChart['data']) > 0)
                @php $maxRevenue = max($revenueChart['data']); @endphp
                <div class="flex items-end gap-1.5 h-48 overflow-x-auto pb-2">
                    @foreach($revenueChart['data'] as $i => $value)
                        @php
                            $pct = $maxRevenue > 0 ? ($value / $maxRevenue) * 100 : 0;
                            $barColor = $value > 0 ? 'bg-brand' : 'bg-white/5';
                        @endphp
                        <div class="flex flex-col items-center flex-shrink-0" style="width: 2rem;">
                            <div class="w-full rounded-t-md {{ $barColor }}" style="height: {{ max(2, $pct) }}%; min-height: {{ $value > 0 ? '4px' : '0' }};"></div>
                            <span class="text-[8px] text-gray-500 mt-1.5 -rotate-45 whitespace-nowrap origin-left">{{ $revenueChart['labels'][$i] }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex items-center justify-center h-48 text-gray-500 text-sm">{{ __('No revenue data for this period') }}</div>
            @endif
        </div>

        <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
            <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">{{ __('Order Status') }}</h3>
            @php
                $statusLabels = ['pending' => 'Pending', 'confirmed' => 'Confirmed', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'completed' => 'Completed', 'cancelled' => 'Cancelled'];
                $statusColors = ['pending' => 'bg-yellow-500', 'confirmed' => 'bg-blue-500', 'shipped' => 'bg-purple-500', 'delivered' => 'bg-brand', 'completed' => 'bg-green-500', 'cancelled' => 'bg-red-500'];
                $totalStatus = array_sum($ordersByStatus->toArray());
            @endphp
            <div class="space-y-3">
                @forelse($statusLabels as $key => $label)
                    @php
                        $count = $ordersByStatus[$key] ?? 0;
                        $pct = $totalStatus > 0 ? ($count / $totalStatus) * 100 : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-300">{{ __($label) }}</span>
                            <span class="text-white font-bold">{{ $count }}</span>
                        </div>
                        <div class="w-full bg-white/5 rounded-full h-2 overflow-hidden">
                            <div class="{{ $statusColors[$key] ?? 'bg-gray-500' }} h-full rounded-full transition-all" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">{{ __('No orders') }}</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
            <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">{{ __('Top Selling Products') }}</h3>
            @forelse($topProducts as $tp)
                <div class="flex items-center gap-4 py-3 border-b border-white/5 last:border-0">
                    <div class="w-10 h-10 rounded-xl overflow-hidden bg-[#1e222b] flex-shrink-0">
                        @if($tp->product && $tp->product->image)
                            <img src="{{ asset('storage/' . $tp->product->image) }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-white truncate">{{ $tp->product?->name ?? 'Deleted Product' }}</p>
                        <p class="text-xs text-gray-500">{{ $tp->total_qty }} {{ __('sold') }} &middot; ${{ number_format($tp->total_revenue, 2) }}</p>
                    </div>
                    <span class="text-xs font-bold text-brand">{{ $tp->total_qty }}x</span>
                </div>
            @empty
                <p class="text-gray-500 text-sm">{{ __('No products sold in this period') }}</p>
            @endforelse
        </div>

        <div class="space-y-6">
            <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
                <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">{{ __('Payment Status') }}</h3>
                @php
                    $payLabels = ['unpaid' => 'Unpaid', 'pending_confirmation' => 'Pending Confirmation', 'paid' => 'Paid'];
                    $payColors = ['unpaid' => 'bg-gray-500', 'pending_confirmation' => 'bg-yellow-500', 'paid' => 'bg-brand'];
                    $totalPay = array_sum($paymentStatusStats->toArray());
                @endphp
                <div class="space-y-3">
                    @forelse($payLabels as $key => $label)
                        @php
                            $count = $paymentStatusStats[$key] ?? 0;
                            $pct = $totalPay > 0 ? ($count / $totalPay) * 100 : 0;
                        @endphp
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-300">{{ __($label) }}</span>
                                <span class="text-white font-bold">{{ $count }}</span>
                            </div>
                            <div class="w-full bg-white/5 rounded-full h-2 overflow-hidden">
                                <div class="{{ $payColors[$key] ?? 'bg-gray-500' }} h-full rounded-full transition-all" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">{{ __('No orders') }}</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
                <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">{{ __('Payment Methods') }}</h3>
                @php
                    $methodLabels = ['aba' => 'ABA Bank', 'acleda' => 'ACLEDA Bank', 'wing' => 'Wing', 'bank_transfer' => 'Bank Transfer'];
                @endphp
                <div class="space-y-2">
                    @forelse($methodLabels as $key => $label)
                        @php $count = $paymentMethodStats[$key] ?? 0; @endphp
                        <div class="flex justify-between text-sm py-2 border-b border-white/5 last:border-0">
                            <span class="text-gray-300">{{ $label }}</span>
                            <span class="text-white font-bold">{{ $count }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">{{ __('No payments') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-sm font-bold text-white uppercase tracking-wider">{{ __('Stock Overview') }}</h3>
            <div class="flex items-center gap-3">
                <span class="text-xs text-gray-500">{{ __('Inventory Value: $') }}{{ number_format($inventoryValue, 2) }}</span>
                <a href="{{ route('admin.reports.export-stock') }}" class="inline-flex items-center gap-1.5 bg-brand text-darkbg font-bold px-3 py-1.5 rounded-xl text-[10px] hover:bg-brand/90 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    {{ __('Export Stock') }}
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
            <div class="bg-white/[0.02] border border-white/5 rounded-2xl p-4">
                <p class="text-xs text-gray-500">{{ __('In Stock') }}</p>
                <p class="text-xl font-black text-white mt-1">{{ $productsInStock }}</p>
            </div>
            <div class="bg-white/[0.02] border border-white/5 rounded-2xl p-4">
                <p class="text-xs text-gray-500">{{ __('Low Stock') }}</p>
                <p class="text-xl font-black text-yellow-400 mt-1">{{ $productsLowStock }}</p>
            </div>
            <div class="bg-white/[0.02] border border-white/5 rounded-2xl p-4">
                <p class="text-xs text-gray-500">{{ __('Out of Stock') }}</p>
                <p class="text-xl font-black text-red-400 mt-1">{{ $productsOutOfStock }}</p>
            </div>
            <div class="bg-white/[0.02] border border-white/5 rounded-2xl p-4">
                <p class="text-xs text-gray-500">{{ __('Total Sold') }}</p>
                <p class="text-xl font-black text-brand mt-1">{{ $stockList->sum('total_sold') }}</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5 text-left">
                        <th class="pb-3 text-[10px] font-bold uppercase tracking-wider text-gray-500">{{ __('Product') }}</th>
                        <th class="pb-3 text-[10px] font-bold uppercase tracking-wider text-gray-500">{{ __('Category') }}</th>
                        <th class="pb-3 text-[10px] font-bold uppercase tracking-wider text-gray-500 text-center">{{ __('In Stock') }}</th>
                        <th class="pb-3 text-[10px] font-bold uppercase tracking-wider text-gray-500 text-center">{{ __('Sold') }}</th>
                        <th class="pb-3 text-[10px] font-bold uppercase tracking-wider text-gray-500 text-center">{{ __('Revenue') }}</th>
                        <th class="pb-3 text-[10px] font-bold uppercase tracking-wider text-gray-500 text-center">{{ __('Status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stockList as $item)
                        <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                            <td class="py-3 pr-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('storage/' . $item->image) }}" class="w-10 h-8 rounded-lg object-cover border border-white/5">
                                    <span class="text-sm font-semibold text-white">{{ $item->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 pr-4">
                                <span class="text-xs text-gray-400">{{ $item->category->name }}</span>
                            </td>
                            <td class="py-3 pr-4 text-center">
                                <span class="text-sm font-bold text-white">{{ $item->stock }}</span>
                            </td>
                            <td class="py-3 pr-4 text-center">
                                <span class="text-sm font-bold text-gray-300">{{ $item->total_sold }}</span>
                            </td>
                            <td class="py-3 pr-4 text-center">
                                <span class="text-sm font-bold text-brand">${{ number_format($item->total_revenue, 2) }}</span>
                            </td>
                            <td class="py-3 text-center">
                                @if($item->stock > 10)
                                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-brand/10 text-brand">{{ __('In Stock') }}</span>
                                @elseif($item->stock > 0)
                                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-yellow-500/10 text-yellow-400">{{ __('Low Stock') }}</span>
                                @else
                                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-red-500/10 text-red-400">{{ __('Out of Stock') }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-500 text-sm">{{ __('No products found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-brand/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-black text-white">{{ $totalProducts }}</p>
                    <p class="text-xs text-gray-400">{{ __('Total Products') }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-brand/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-black text-white">{{ $totalCategories }}</p>
                    <p class="text-xs text-gray-400">{{ __('Total Categories') }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-brand/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-black text-white">{{ $totalCustomers }}</p>
                    <p class="text-xs text-gray-400">{{ __('Total Customers') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
