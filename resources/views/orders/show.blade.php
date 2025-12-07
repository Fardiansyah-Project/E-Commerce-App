@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-5 py-10">

        <h2 class="text-3xl font-semibold mb-6">Detail Pesanan</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded-lg mb-5">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-xl shadow">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <p class="mb-2"><strong>Nomor Order:</strong> {{ $order->order_no }}</p>
                    <p class="mb-2"><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                    <p class="mb-2"><strong>Alamat Pengiriman:</strong> {{ $order->shipping_address }}</p>
                </div>

                <div>
                    <p class="mb-2">
                        <strong>Status Pembayaran:</strong>
                        <span
                            class="
                        px-3 py-1 rounded-full text-white text-xs
                        @if ($order->payment_status == 'PENDING') bg-yellow-500
                        @elseif($order->payment_status == 'PAID') bg-green-600
                        @else bg-gray-600 @endif">
                            {{ $order->payment_status }}
                        </span>
                    </p>

                    <p class="mb-2">
                        <strong>Status Pesanan:</strong>
                        <span
                            class="
                        px-3 py-1 rounded-full text-white text-xs
                        @if ($order->status == 'PENDING') bg-yellow-500
                        @elseif($order->status == 'PROCESSING') bg-blue-600
                        @elseif($order->status == 'COMPLETED') bg-green-600
                        @elseif($order->status == 'CANCELLED') bg-red-600
                        @else bg-gray-600 @endif">
                            {{ $order->status }}
                        </span>
                    </p>

                    <p class="mb-2">
                        <strong>Metode Pembayaran: </strong>
                        <span class="
                        px-3 py-1 rounded-full bg-blue-500 text-white text-xs">
                            {{ $order->payment_method }}
                        </span>
                    </p>
                </div>

            </div>

            <hr class="my-6">

            <h3 class="text-xl font-semibold mb-4">Produk Dalam Pesanan</h3>

            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-3">Produk</th>
                        <th class="py-3 text-center">Jumlah</th>
                        <th class="py-3 text-center">Harga</th>
                        <th class="py-3 text-center">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($order->items as $item)
                        <tr class="border-b">
                            <td class="py-3">{{ $item->product->name }}</td>
                            <td class="py-3 text-center">{{ $item->qty }}</td>
                            <td class="py-3 text-center">Rp {{ number_format($item->price) }}</td>
                            <td class="py-3 text-center">Rp {{ number_format($item->price * $item->qty) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right mt-6">
                <p class="text-xl font-semibold">
                    Total: Rp {{ number_format($order->total_amount) }}
                </p>
            </div>

        </div>

    </div>
@endsection
