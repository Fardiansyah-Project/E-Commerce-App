@extends('layouts.app')
@section('content')

    <div class="container mx-auto px-5 py-10">

        <h2 class="text-3xl font-semibold mb-6">Pesanan Saya</h2>

        @if ($orders->isEmpty())
            <p class="text-gray-500">Belum ada pesanan.</p>
        @else
            <div class="bg-white rounded-xl shadow p-6">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3">No Order</th>
                            <th class="py-3">Tanggal</th>
                            <th class="py-3">Total</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-b hover:bg-gray-50 transition">
                                {{-- <td class="py-3">{{ $order->items->first()->product->name ?? 'Produk tidak tersedia' }}</td> --}}
                                <td class="py-3">{{ $order->order_no }}</td>
                                <td class="py-3">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="py-3">Rp {{ number_format($order->total_amount) }}</td>
                                {{-- Status Badge --}}
                                <td class="py-3">
                                    <span
                                        class="
                                    px-3 py-1 rounded-full text-white text-xs
                                    @if ($order->status == 'PENDING') bg-yellow-500
                                    @elseif($order->status == 'PAID') bg-green-600
                                    @elseif($order->status == 'CANCELLED') bg-red-600
                                    @else bg-gray-600 @endif">
                                        {{ $order->status }}
                                    </span>
                                </td>

                                <td class="py-3 text-center">
                                    <a href="{{ route('orders.show', $order->id) }}"
                                        class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>

@endsection
