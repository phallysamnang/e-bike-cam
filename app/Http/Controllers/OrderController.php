<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function myOrders()
    {
        $orders = Order::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(20);

        return view('my-orders', compact('orders'));
    }

    public function create(Product $product)
    {
        $product->load('category');
        return view('order-create', compact('product'));
    }

    public function acceptDelivery(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status !== 'delivered') {
            return redirect()->route('orders.my')->with('error', 'Order cannot be accepted at this stage.');
        }

        $order->update(['status' => 'completed']);

        return redirect()->route('orders.my')->with('success', 'Delivery confirmed! Thank you for your order.');
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if (!in_array($order->status, ['pending', 'confirmed'])) {
            return redirect()->route('orders.my')
                ->with('error', 'This order cannot be cancelled at this stage.');
        }

        $wasConfirmed = $order->status === 'confirmed';
        $order->update(['status' => 'cancelled']);

        if ($wasConfirmed) {
            $order->product->increment('stock', $order->quantity);
        }

        return redirect()->route('orders.my')
            ->with('success', 'Order cancelled successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_phone' => 'nullable',
            'customer_address' => 'required',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return redirect()->back()
                ->with('error', __('Insufficient stock! Only :stock units available.', ['stock' => $product->stock]))
                ->withInput();
        }

        $total = $product->price * $request->quantity;

        Order::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'quantity' => $request->quantity,
            'total_price' => $total,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('orders.my')
            ->with('success', 'Order placed successfully! We will contact you soon.');
    }
}
