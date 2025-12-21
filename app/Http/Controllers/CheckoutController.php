<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart()->with('items.product')->first();

        if (!$cart || $cart->items->count() == 0)
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');

        return view('checkout', compact('cart'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'payment_method' => 'required',
            'address'        => 'required|string|max:255',
            'payment_proof'  => 'required_if:payment_method,TRANSFER',
        ], [
            'payment_method.required' => 'Metode pembayaran harus dipilih.',
            'address.required' => 'Alamat pengiriman harus diisi.',
            'payment_proof.required_if' => 'Bukti pembayaran harus diunggah jika metode pembayaran transfer.'
        ]);

        $cart = auth()->user()->cart()->with('items.product')->first();

        if (!$cart || $cart->items->count() == 0)
            return back()->with('error', 'Keranjang kosong.');

        $order = Order::create([
            'user_id'         => auth()->id(),
            'order_no'        => 'ORD' . time(),
            'total_amount'    => $cart->items->sum(fn($i) => $i->qty * $i->price_snapshot),
            'shipping_address' => $r->address,
            'payment_method'  => $r->payment_method,
            'payment_status'  => 'PENDING',
            'payment_proof' => $r->file('payment_proof') ? $r->file('payment_proof')->store('payment_proofs', 'public') : null,
            'status'          => 'PENDING'
        ]);

        foreach ($cart->items as $item) {
            // OrderItem::create([
            //     'order_id' => $order->id,
            //     'product_id' => $item->product_id,
            //     'qty'      => $item->qty,
            //     $item->product->decrement('stock', $item->qty),
            //     'price'    => $item->price_snapshot,
            //     'subtotal' => $item->qty * $item->price_snapshot,
            // ]);
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->qty = $item->qty;
            //Mengurangi stok produk ketika status pesanan selesai
            if($order->status == 'COMPLETED') {
                $item->product->decrement('stock', $item->qty);
            }
            $orderItem->price = $item->price_snapshot;
            $orderItem->subtotal = $item->qty * $item->price_snapshot;
            $orderItem->save();
        }

        $cart->items()->delete(); 

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Pesanan telah dibuat.');
    }
    
}
