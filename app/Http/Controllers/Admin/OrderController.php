<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('product');

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $orders = $query->latest()->paginate(20)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('product.category', 'user');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,shipped,delivered,cancelled',
        ]);

        $previousStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        if ($request->status === 'confirmed' && $previousStatus !== 'confirmed') {
            $order->product->decrement('stock', $order->quantity);
        }

        if ($request->status === 'cancelled' && in_array($previousStatus, ['confirmed', 'shipped', 'delivered'])) {
            $order->product->increment('stock', $order->quantity);
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order status updated to ' . ucfirst($order->status));
    }

    public function confirmPayment(Order $order)
    {
        $order->payment_status = 'paid';
        $order->paid_at = now();
        $order->save();

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Payment confirmed for Order #' . $order->id);
    }

    public function pendingPayments()
    {
        $count = Order::where('payment_status', 'pending_confirmation')->count();

        return response()->json(['count' => $count]);
    }
}
