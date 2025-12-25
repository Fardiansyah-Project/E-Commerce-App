<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /**
         * =========================
         * CARD STATISTICS
         * =========================
         */

        // Total Pendapatan (Order PAID / COMPLETED)
        $totalRevenue = Order::whereIn('status', ['COMPLETED'])
            ->sum('total_amount');

        // Total Orders
        $totalOrders = Order::count();

        // Total Sepatu Terjual
        $totalSold = OrderItem::whereHas('order', function ($q) {
            $q->whereIn('status', ['PAID', 'COMPLETED']);
        })->sum('qty');

        /**
         * =========================
         * TRAFIK PENJUALAN (%)
         * =========================
         */

        $thisMonth = Order::whereIn('status', ['PAID', 'COMPLETED'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        $lastMonth = Order::whereIn('status', ['PAID', 'COMPLETED'])
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        $trafficGrowth = $lastMonth > 0
            ? (($thisMonth - $lastMonth) / $lastMonth) * 100
            : 0;

        /**
         * =========================
         * SALES OVERVIEW (GRAFIK)
         * =========================
         */

        $salesChart = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_amount) as total')
        )
            ->whereIn('status', ['PAID', 'COMPLETED'])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        /**
         * =========================
         * TOP SELLING PRODUCTS
         * =========================
         */

        $topProducts = Product::withSum(['orderItems as total_sold' => function ($q) {
            $q->whereHas('order', function ($order) {
                $order->whereIn('status', ['PAID', 'COMPLETED']);
            });
        }], 'qty')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        /**
         * =========================
         * RECENT ORDERS
         * =========================
         */

        $recentOrders = Order::with('items.product', 'user')
            ->latest()
            ->take(5)
            ->get();

        // dd($salesChart);
        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalSold',
            'trafficGrowth',
            'salesChart',
            'topProducts',
            'recentOrders'
        ));
    }
}
