<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payment', compact('order'));
    }

    public function uploadProof(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->payment_status === 'paid') {
            return redirect()->route('orders.my')
                ->with('error', 'This order is already paid.');
        }

        $request->validate([
            'payment_method' => 'required|in:aba,acleda,wing,bank_transfer',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'payment_notes' => 'nullable|string|max:500',
        ]);

        $file = $request->file('payment_proof');
        $path = $file->store('payment-proofs', 'public');

        $order->update([
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending_confirmation',
            'payment_proof' => $path,
            'payment_notes' => $request->payment_notes,
        ]);

        return redirect()->route('orders.my')
            ->with('success', 'Payment proof submitted! Admin will verify your payment soon.');
    }
}
