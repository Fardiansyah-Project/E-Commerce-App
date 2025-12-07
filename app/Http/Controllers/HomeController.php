<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showProducts()
    {
        $products = Product::where('is_active', True)->get();

        return view('products', compact('products'));
    
    }

    public function index()
    {
        $latest = Product::latest()->take(8)->get();
        $bestSeller = Product::withCount('orderItems')
            ->orderBy('order_items_count', 'DESC')
            ->take(8)->get();

        // return view('home', [
        //     'latest'     => Product::latest()->take(8)->get(),
        //     'bestSeller' => Product::withCount('orderItems')
        //         ->orderBy('order_items_count', 'DESC')
        //         ->take(8)->get(),
        // ]);
        return view('home', compact('latest', 'bestSeller'));
    }
}
