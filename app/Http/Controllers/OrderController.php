<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('items.product')->get();

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Auth::user()->orders()->with('items.product')->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Auth::user()->orders()->findOrFail($id);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status order berhasil diperbarui.');
    }
    
    public function uploadPaymentProof(Request $r, $id)
    {
        $r->validate([
            'payment_proof' => 'required|image|max:2048'
        ]);

        $order = Auth::user()->orders()->findOrFail($id);

        $path = $r->file('payment_proof')->store('payment_proofs', 'public');

        $order->paymentProof()->create([
            'file_path' => $path,
            'uploaded_at' => now()
        ]);

        $order->update(['payment_status' => 'UNDER_REVIEW']);

        return back()->with('success', 'Bukti pembayaran berhasil diunggah.');
    }

    public function cancel($id)
    {
        $order = Auth::user()->orders()->findOrFail($id);

        if ($order->status !== 'PENDING') {
            return back()->with('error', 'Hanya order dengan status PENDING yang dapat dibatalkan.');
        }

        $order->update(['status' => 'CANCELLED']);

        return back()->with('success', 'Order berhasil dibatalkan.');
    }

    public function store(Request $request)
    {
        // Ambil cart milik user
        $cartItems = Cart::where('user_id', Auth::id())->get();

        if ($cartItems->count() == 0) {
            return redirect()->back()->with('error', 'Keranjang kamu kosong');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->qty;
        });

        // 1. Simpan data order
        $order = Order::create([
            'invoice' => 'INV-' . time(),
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending',
            'address' => $request->address,
        ]);

        // 2. Simpan detail item
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'price' => $item->product->price,
            ]);
        }

        // 3. Kosongkan cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Pesanan berhasil dibuat!');
    }
}
