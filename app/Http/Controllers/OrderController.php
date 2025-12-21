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
    public function getAllData()
    {
        $orders = Order::paginate(10);

        return view('admin.orders.history', compact('orders'));
    }
    public function getOrder()
    {
        $orders = Order::where('status', 'PENDING')->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function getSuccess()
    {
        $orders = Order::where('status', 'COMPLETED')->paginate(10);

        return view('admin.orders.success', compact('orders'));
    }
    public function index()
    {
        $orders = Auth::user()
            ->orders()
            ->where('is_hidden_by_user', false)
            ->with('items.product')
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Auth::user()->orders()->with('items.product')->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    public function editStatus($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update(['status' => $request->status]);
        if ($order->status == 'COMPLETED') {
            $order->items()->each(function ($item) {
                $item->product->decrement('stock', $item->qty);
            });
        }
        
        $order->update(['payment_status' => $request->payment_status]);
        // if ($order->payment_status == 'COMPLETED') {
        //     $order->items()->each(function ($item) {
        //         $item->product->decrement('stock', $item->qty);
        //     });
        // }

        if ($order->status == 'CANCELLED') {
            $order->items()->each(function ($item) {
                $item->product->increment('stock', $item->qty);
            });
        }
        return redirect()->back()->with('success', 'Status pesanan berhasil diubah.');
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

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'price' => $item->product->price,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Pesanan berhasil dibuat!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == 'PENDING') {
            return redirect()->route('admin.orders.index')->with('error', 'Pesanan sudah selesai, tidak bisa dihapus!');
        }
        $order->delete();

        return redirect()->route('admin.orders.history')->with('success', 'Data pesanan berhasil dihapus!');
    }

    public function destroyItems($id)
    {
        $order = Auth::user()->orders()->findOrFail($id);
        if (in_array($order->status, ['PENDING'])) {
            return back()->with('error', 'Order belum selesai, tidak bisa dihapus.');
        }

        $order->update([
            'is_hidden_by_user' => true
        ]);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pesanan berhasil dihapus dari daftar kamu.');
    }

    public function restore($id)
    {
        $order = Auth::user()
            ->orders()
            ->where('is_hidden_by_user', true)
            ->findOrFail($id);

        $order->update([
            'is_hidden_by_user' => false
        ]);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pesanan berhasil dipulihkan.');
    }

    public function trashed()
    {
        $orders = Auth::user()
            ->orders()
            ->where('is_hidden_by_user', true)
            ->with('items.product')
            ->get();

        return view('orders.trashed', compact('orders'));
    }
}
