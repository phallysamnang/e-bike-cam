<?php

namespace App\View\Components;

use App\Models\Order;
use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    public int $pendingPaymentsCount;

    public function __construct()
    {
        $this->pendingPaymentsCount = Order::where('payment_status', 'pending_confirmation')->count();
    }

    public function render(): View
    {
        return view('layouts.admin');
    }
}
