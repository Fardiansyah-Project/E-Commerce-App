<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart()->with('items.product')->first();
        return view('cart.index', compact('cart'));
    }

    public function add(Request $r)
    {
        $r->validate([
            'product_id' => 'required',
            'qty'        => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $cart = $user->cart()->firstOrCreate([]);

        $product = Product::findOrFail($r->product_id);

        // cek apakah item sudah ada di keranjang
        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->qty += 1;
            $item->save();
        } else {
            $cart->items()->create([
                'product_id'     => $product->id,
                'qty'            => 1,
                'price_snapshot' => $product->price
            ]);
        }

        return back()->with('success', 'Produk masuk keranjang!');
    }


    public function remove(Request $r, $itemId)
    {
        $cart = Auth::user()->cart()->first();

        if (!$cart) {
            return back()->withErrors(['error' => 'Keranjang tidak ditemukan.']);
        }

        $item = $cart->items()->where('id', $itemId)->first();

        if (!$item) {
            return back()->withErrors(['error' => 'Item tidak ditemukan di keranjang.']);
        }

        $item->delete();

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
    public function increaseQty($id)
    {
        $cart = auth()->user()->cart;
        $item = $cart->items()->where('id', $id)->firstOrFail();

        $item->qty += 1;
        $item->save();

        return back()->with('success', 'Jumlah produk ditambah.');
    }

    public function decreaseQty($id)
    {
        $cart = Auth::user()->cart;
        $item = $cart->items()->where('id', $id)->firstOrFail();

        if ($item->qty > 1) {
            $item->qty -= 1;
            $item->save();
        } else {
            $item->delete(); // jika qty = 0, hapus item
        }

        return back()->with('success', 'Jumlah produk dikurangi.');
    }
}
