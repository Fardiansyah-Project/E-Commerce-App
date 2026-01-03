@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-5 py-6 sm:py-10">

        <h2 class="text-2xl sm:text-3xl font-semibold mb-4 sm:mb-6">Pesanan Saya</h2>

        @if ($orders->isEmpty())
            <div class="bg-white p-8 rounded-xl shadow text-center">
                <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <p class="text-gray-500 text-lg mb-4">Belum ada pesanan.</p>
                <a href="{{ url('/products') }}"
                    class="inline-block bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="bg-white rounded-xl shadow overflow-hidden">

                <!-- Desktop Table View -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">No Order</th>
                                <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                                <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Total</th>
                                <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Status</th>
                                <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="py-4 px-6">
                                        <p class="font-semibold text-gray-900">{{ $order->order_no }}</p>
                                    </td>
                                    <td class="py-4 px-6 text-gray-700">
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>
                                    <td class="py-4 px-6 font-semibold text-gray-900">
                                        Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span
                                            class="inline-block px-3 py-1 rounded-full text-white text-xs font-semibold
                                            @if ($order->status == 'PENDING') bg-yellow-500
                                            @elseif($order->status == 'COMPLETED') bg-green-600
                                            @elseif($order->status == 'CANCELLED') bg-red-600
                                            @else bg-blue-500 @endif">
                                            @if ($order->status == 'PENDING')
                                                Menunggu Konfirmasi
                                            @elseif($order->status == 'COMPLETED')
                                                Diterima
                                            @elseif($order->status == 'CANCELLED')
                                                Dibatalkan
                                            @else
                                                Telah dikonfirmasi
                                            @endif
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex gap-2 justify-center">
                                            <a href="{{ route('orders.show', $order->id) }}"
                                                class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition text-sm">
                                                Detail
                                            </a>
                                            @if ($order->status == 'PENDING')
                                                <form action="{{ route('orders.cancel', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="CANCELLED">
                                                    <button type="submit"
                                                        onclick="return confirm('Yakin ingin membatalkan pesanan ini?')"
                                                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition text-sm">
                                                        Batalkan
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('orders.destroy', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Yakin ingin menghapus pesanan ini?')"
                                                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition text-sm">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="lg:hidden p-4 space-y-4">
                    @foreach ($orders as $order)
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <!-- Order Header -->
                            <div class="flex justify-between items-start mb-4 pb-4 border-b">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Nomor Order</p>
                                    <p class="font-bold text-gray-900">{{ $order->order_no }}</p>
                                </div>
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-white text-xs font-semibold
                                    @if ($order->status == 'PENDING') bg-yellow-500
                                    @elseif($order->status == 'COMPLETED') bg-green-600
                                    @elseif($order->status == 'CANCELLED') bg-red-600
                                    @else bg-blue-500 @endif">
                                    @if ($order->status == 'PENDING')
                                        Menunggu
                                    @elseif($order->status == 'COMPLETED')
                                        Diterima
                                    @elseif($order->status == 'CANCELLED')
                                        Dibatalkan
                                    @else
                                        Dikonfirmasi
                                    @endif
                                </span>
                            </div>

                            <!-- Order Details -->
                            <div class="space-y-2 mb-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">
                                        <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                        Tanggal
                                    </span>
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ $order->created_at->format('d M Y') }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">
                                        <i class="fas fa-money-bill-wave mr-2 text-gray-400"></i>
                                        Total Pembayaran
                                    </span>
                                    <span class="text-lg font-bold text-gray-900">
                                        Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ route('orders.show', $order->id) }}"
                                    class="bg-black text-white text-center py-2 px-4 rounded-lg hover:bg-gray-800 transition text-sm">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                                @if ($order->status == 'PENDING')
                                    <form action="{{ route('orders.cancel', $order->id) }}" method="post" class="w-full">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="CANCELLED">
                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin membatalkan pesanan ini?')"
                                            class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition text-sm">
                                            <i class="fas fa-times mr-1"></i> Batalkan
                                        </button>
                                    </form>
                                    {{-- <a href="{{ route('orders.cancel', $order->id) }}" data-confirm-delete="true"
                                        class=" text-center w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition text-sm">
                                        <i class="fas fa-times mr-1"></i> Batalkan
                                    </a> --}}
                                @else
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="post" class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus pesanan ini?')"
                                            class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition text-sm">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination (if needed) -->
                @if ($orders->hasPages())
                    <div class="p-4 border-t bg-gray-50">
                        {{ $orders->links() }}
                    </div>
                @endif

            </div>

            <!-- Summary Card -->
            <div class="mt-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Pesanan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $orders->count() }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Sedang Diproses</p>
                        <p class="text-2xl font-bold text-yellow-600">
                            {{ $orders->where('status', 'PENDING')->count() }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Selesai</p>
                        <p class="text-2xl font-bold text-green-600">
                            {{ $orders->where('status', 'COMPLETED')->count() }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
