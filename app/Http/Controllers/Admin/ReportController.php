<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'today');

        $dates = $this->getDateRange($period, $request);

        $fromDate = $dates['from'];
        $toDate = $dates['to'];

        $ordersQuery = Order::query()
            ->whereBetween('created_at', [$fromDate, $toDate]);

        $completedQuery = Order::query()
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->where('payment_status', 'paid');

        $totalOrders = (clone $ordersQuery)->count();
        $totalRevenue = (clone $completedQuery)->sum('total_price');
        $totalProductsSold = (clone $ordersQuery)->sum('quantity');
        $avgOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        $ordersByStatus = (clone $ordersQuery)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $paymentMethodStats = (clone $ordersQuery)
            ->whereNotNull('payment_method')
            ->selectRaw('payment_method, count(*) as count')
            ->groupBy('payment_method')
            ->pluck('count', 'payment_method');

        $paymentStatusStats = (clone $ordersQuery)
            ->selectRaw('payment_status, count(*) as count')
            ->groupBy('payment_status')
            ->pluck('count', 'payment_status');

        $topProducts = (clone $ordersQuery)
            ->selectRaw('product_id, sum(quantity) as total_qty, sum(total_price) as total_revenue')
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->take(10)
            ->get()
            ->load('product');

        $revenueChart = $this->getRevenueChart($period, $fromDate, $toDate);

        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalCustomers = User::count();

        $currentPeriodName = match($period) {
            'today' => __('Today'),
            'yesterday' => __('Yesterday'),
            'this_week' => __('This Week'),
            'last_week' => __('Last Week'),
            'this_month' => __('This Month'),
            'last_month' => __('Last Month'),
            'this_year' => __('This Year'),
            'last_year' => __('Last Year'),
            'custom' => __('Custom Range'),
            default => __('All Time'),
        };

        $productsInStock = Product::where('stock', '>', 0)->count();
        $productsLowStock = Product::where('stock', '>', 0)->where('stock', '<=', 5)->count();
        $productsOutOfStock = Product::where('stock', 0)->count();
        $inventoryValue = Product::sum(\Illuminate\Support\Facades\DB::raw('stock * price'));

        $stockList = Product::with('category')
            ->select('products.*')
            ->selectSub(function ($q) {
                $q->from('orders')
                    ->whereColumn('product_id', 'products.id')
                    ->selectRaw('COALESCE(SUM(quantity), 0)');
            }, 'total_sold')
            ->selectSub(function ($q) {
                $q->from('orders')
                    ->whereColumn('product_id', 'products.id')
                    ->selectRaw('COALESCE(SUM(total_price), 0)');
            }, 'total_revenue')
            ->orderByRaw('stock ASC')
            ->get();

        return view('admin.reports.index', compact(
            'period',
            'fromDate',
            'toDate',
            'totalOrders',
            'totalRevenue',
            'totalProductsSold',
            'avgOrderValue',
            'ordersByStatus',
            'paymentMethodStats',
            'paymentStatusStats',
            'topProducts',
            'revenueChart',
            'totalProducts',
            'totalCategories',
            'totalCustomers',
            'currentPeriodName',
            'productsInStock',
            'productsLowStock',
            'productsOutOfStock',
            'inventoryValue',
            'stockList'
        ));
    }

    private function getDateRange(string $period, Request $request): array
    {
        $now = Carbon::now();

        return match($period) {
            'today' => ['from' => $now->copy()->startOfDay(), 'to' => $now->copy()->endOfDay()],
            'yesterday' => ['from' => $now->copy()->subDay()->startOfDay(), 'to' => $now->copy()->subDay()->endOfDay()],
            'this_week' => ['from' => $now->copy()->startOfWeek(), 'to' => $now->copy()->endOfWeek()],
            'last_week' => ['from' => $now->copy()->subWeek()->startOfWeek(), 'to' => $now->copy()->subWeek()->endOfWeek()],
            'this_month' => ['from' => $now->copy()->startOfMonth(), 'to' => $now->copy()->endOfMonth()],
            'last_month' => ['from' => $now->copy()->subMonth()->startOfMonth(), 'to' => $now->copy()->subMonth()->endOfMonth()],
            'this_year' => ['from' => $now->copy()->startOfYear(), 'to' => $now->copy()->endOfYear()],
            'last_year' => ['from' => $now->copy()->subYear()->startOfYear(), 'to' => $now->copy()->subYear()->endOfYear()],
            'custom' => [
                'from' => $request->filled('from_date') ? Carbon::parse($request->from_date)->startOfDay() : $now->copy()->startOfMonth(),
                'to' => $request->filled('to_date') ? Carbon::parse($request->to_date)->endOfDay() : $now->copy()->endOfDay(),
            ],
            default => ['from' => Carbon::create(2000), 'to' => $now->copy()->endOfDay()],
        };
    }

    private function getRevenueChart(string $period, Carbon $from, Carbon $to): array
    {
        $data = [];
        $labels = [];

        if (in_array($period, ['today', 'yesterday'])) {
            for ($h = 0; $h < 24; $h++) {
                $hourStart = $from->copy()->startOfDay()->addHours($h);
                $hourEnd = $hourStart->copy()->endOfHour();
                $revenue = Order::where('payment_status', 'paid')
                    ->whereBetween('paid_at', [$hourStart, $hourEnd])
                    ->sum('total_price');
                $labels[] = $hourStart->format('H:00');
                $data[] = (float) $revenue;
            }
        } elseif (in_array($period, ['this_week', 'last_week'])) {
            for ($d = 0; $d < 7; $d++) {
                $dayStart = $from->copy()->startOfWeek()->addDays($d);
                $dayEnd = $dayStart->copy()->endOfDay();
                $revenue = Order::where('payment_status', 'paid')
                    ->whereBetween('paid_at', [$dayStart, $dayEnd])
                    ->sum('total_price');
                $labels[] = $dayStart->format('D');
                $data[] = (float) $revenue;
            }
        } elseif (in_array($period, ['this_month', 'last_month', 'custom'])) {
            $daysInPeriod = $from->daysUntil($to)->count();
            $interval = $daysInPeriod > 31 ? 'week' : 'day';
            if ($interval === 'day') {
                $current = $from->copy();
                while ($current->lte($to)) {
                    $dayEnd = $current->copy()->endOfDay();
                    $revenue = Order::where('payment_status', 'paid')
                        ->whereBetween('paid_at', [$current, $dayEnd])
                        ->sum('total_price');
                    $labels[] = $current->format('M d');
                    $data[] = (float) $revenue;
                    $current->addDay();
                }
            } else {
                $current = $from->copy()->startOfWeek();
                while ($current->lte($to)) {
                    $weekEnd = $current->copy()->endOfWeek();
                    $revenue = Order::where('payment_status', 'paid')
                        ->whereBetween('paid_at', [$current, $weekEnd])
                        ->sum('total_price');
                    $labels[] = $current->format('M d');
                    $data[] = (float) $revenue;
                    $current->addWeek();
                }
            }
        } elseif (in_array($period, ['this_year', 'last_year'])) {
            for ($m = 1; $m <= 12; $m++) {
                $monthStart = $from->copy()->month($m)->startOfMonth();
                $monthEnd = $monthStart->copy()->endOfMonth();
                $revenue = Order::where('payment_status', 'paid')
                    ->whereBetween('paid_at', [$monthStart, $monthEnd])
                    ->sum('total_price');
                $labels[] = $monthStart->format('M');
                $data[] = (float) $revenue;
            }
        } else {
            $months = $from->monthsUntil($to)->count();
            if ($months <= 12) {
                for ($m = 1; $m <= 12; $m++) {
                    $monthStart = $from->copy()->month($m)->startOfMonth();
                    $monthEnd = $monthStart->copy()->endOfMonth();
                    $revenue = Order::where('payment_status', 'paid')
                        ->whereBetween('paid_at', [$monthStart, $monthEnd])
                        ->sum('total_price');
                    $labels[] = $monthStart->format('M Y');
                    $data[] = (float) $revenue;
                }
            } else {
                for ($y = $from->year; $y <= $to->year; $y++) {
                    $yearStart = Carbon::create($y)->startOfYear();
                    $yearEnd = $yearStart->copy()->endOfYear();
                    $revenue = Order::where('payment_status', 'paid')
                        ->whereBetween('paid_at', [$yearStart, $yearEnd])
                        ->sum('total_price');
                    $labels[] = (string) $y;
                    $data[] = (float) $revenue;
                }
            }
        }

        return ['labels' => $labels, 'data' => $data];
    }

    public function exportCsv(Request $request)
    {
        $period = $request->get('period', 'today');
        $dates = $this->getDateRange($period, $request);
        $fromDate = $dates['from'];
        $toDate = $dates['to'];

        $orders = Order::with('product')
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->latest()
            ->get();

        $filename = 'report-' . $period . '-' . now()->format('Y-m-d-Hi') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($orders) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'Order ID',
                'Product',
                'Customer Name',
                'Customer Email',
                'Customer Phone',
                'Address',
                'Quantity',
                'Unit Price',
                'Total Price',
                'Order Status',
                'Payment Status',
                'Payment Method',
                'Order Date',
            ]);

            foreach ($orders as $order) {
                fputcsv($handle, [
                    $order->id,
                    $order->product?->name ?? 'Deleted',
                    $order->customer_name,
                    $order->customer_email,
                    $order->customer_phone ?? '',
                    $order->customer_address,
                    $order->quantity,
                    $order->product?->price ?? 0,
                    number_format($order->total_price, 2),
                    $order->status,
                    $order->payment_status,
                    $order->payment_method ?? '',
                    $order->created_at->format('Y-m-d H:i'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportStockCsv()
    {
        $products = Product::with('category')
            ->select('products.*')
            ->selectSub(function ($q) {
                $q->from('orders')
                    ->whereColumn('product_id', 'products.id')
                    ->selectRaw('COALESCE(SUM(quantity), 0)');
            }, 'total_sold')
            ->selectSub(function ($q) {
                $q->from('orders')
                    ->whereColumn('product_id', 'products.id')
                    ->selectRaw('COALESCE(SUM(total_price), 0)');
            }, 'total_revenue')
            ->orderBy('products.name')
            ->get();

        $filename = 'stock-report-' . now()->format('Y-m-d-Hi') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($products) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'Product',
                'Category',
                'Price',
                'In Stock',
                'Total Sold',
                'Revenue',
                'Stock Status',
            ]);

            foreach ($products as $product) {
                $status = $product->stock > 10 ? 'In Stock' : ($product->stock > 0 ? 'Low Stock' : 'Out of Stock');
                fputcsv($handle, [
                    $product->name,
                    $product->category->name,
                    number_format($product->price, 2),
                    $product->stock,
                    $product->total_sold,
                    number_format($product->total_revenue, 2),
                    $status,
                ]);
            }

            $inStock = $products->where('stock', '>', 0)->count();
            $lowStock = $products->where('stock', '>', 0)->where('stock', '<=', 5)->count();
            $outOfStock = $products->where('stock', 0)->count();
            $totalSold = $products->sum('total_sold');
            $inventoryValue = $products->sum(fn($p) => $p->stock * $p->price);

            fputcsv($handle, []);
            fputcsv($handle, ['Summary']);
            fputcsv($handle, ['In Stock', $inStock]);
            fputcsv($handle, ['Low Stock', $lowStock]);
            fputcsv($handle, ['Out of Stock', $outOfStock]);
            fputcsv($handle, ['Total Sold Units', $totalSold]);
            fputcsv($handle, ['Inventory Value', '$' . number_format($inventoryValue, 2)]);

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
