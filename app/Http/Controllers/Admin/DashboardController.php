<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $product_count = Product::count();
        $order_success = Order::where('status', 'completed')->count();
        $order_cancel = Order::where('status', 'cancelled')->count();
        $order = Order::count();

        $total = Order::select(DB::raw("COUNT(*) as count"))
            ->whereYear("created_at", date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');

        return view('admin.dashboard', compact('product_count', 'order_success', 'order_cancel', 'order', 'total'));
    }

    public function total()
    {
        $total = Order::select(DB::raw("COUNT(*) as count"))
            ->whereYear("created_at", date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');

        return view('admin.dashboard', compact('total'));

    }
}
