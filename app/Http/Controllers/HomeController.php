<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
   
    public function showProducts()
    {
        // Produk Terlaris
        $bestSellers = Product::where('is_active', true)
            ->withSum(['orderItems as total_sold' => function ($q) {
                $q->whereHas('order', function ($order) {
                    $order->whereIn('status', ['PAID', 'COMPLETED']);
                });
            }], 'qty')
            ->orderByDesc('total_sold')
            ->take(8)
            ->get();

        // Produk Paling Banyak Dilihat
        $mostViewed = Product::where('is_active', true)
            ->orderByDesc('views')
            ->take(8)
            ->get();

        // Semua produk (default)
        $products = Product::where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('products', compact(
            'products',
            'bestSellers',
            'mostViewed'
        ));
    }


    public function index()
    {
        $latest = Product::latest()->take(8)->get();
        // $bestSeller = Product::withCount('orderItems')
        //     ->orderBy('order_items_count', 'DESC')
        //     ->take(8)->get();

        $bestSellers = Product::where('is_active', true)
            ->withSum(['orderItems as total_sold' => function ($q) {
                $q->whereHas('order', function ($order) {
                    $order->whereIn('status', ['COMPLETED']);
                });
            }], 'qty')
            ->orderByDesc('total_sold')
            ->take(8)
            ->get();

        $mostViewed = Product::where('is_active', true)
            ->orderByDesc('views')
            ->take(8)
            ->get();

        return view('home', compact('latest', 'bestSellers', 'mostViewed'));
    }
}
