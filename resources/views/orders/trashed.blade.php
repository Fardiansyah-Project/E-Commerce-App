@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-5 py-10">
        <h2 class="text-3xl font-semibold mb-6">Pesanan Terhapus</h2>

        @if ($orders->isEmpty())
            <p class="text-gray-500">Tidak ada pesanan terhapus.</p>
        @else
            <div class="bg-white rounded-xl shadow p-6">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3">No Order</th>
                            <th class="py-3">Tanggal</th>
                            <th class="py-3">Total</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-b">
                                <td class="py-3 text-center">{{ $order->order_no }}</td>
                                <td class="py-3 text-center">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="py-3 text-center">Rp {{ number_format($order->total_amount) }}</td>
                                <td class="py-3 text-center">
                                    <form action="{{ route('orders.restore', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                            Restore
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection