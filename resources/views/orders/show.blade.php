@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-5 py-6 sm:py-10">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Detail Pesanan</h2>
            <a href="{{ url('/orders') }}" 
               class="inline-flex items-center justify-center bg-gray-600 hover:bg-gray-700 py-2 px-5 text-white rounded-lg transition text-sm sm:text-base">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded-lg mb-6 flex items-start">
                <i class="fas fa-check-circle text-green-500 mr-3 mt-0.5"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Order Information Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
            
            <!-- Order Header -->
            <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <p class="text-gray-300 text-xs sm:text-sm mb-1">Nomor Pesanan</p>
                        <p class="text-white text-xl sm:text-2xl font-bold">{{ $order->order_no }}</p>
                    </div>
                    <div class="flex gap-2 flex-wrap">
                        <span class="inline-block px-3 py-1 rounded-full text-white text-xs font-semibold
                            @if ($order->status == 'PENDING') bg-yellow-500
                            @elseif($order->status == 'PROCESSING') bg-blue-600
                            @elseif($order->status == 'COMPLETED') bg-green-600
                            @elseif($order->status == 'CANCELLED') bg-red-600
                            @else bg-gray-600 @endif">
                            <i class="fas fa-circle text-xs mr-1"></i>
                            @if ($order->status == 'PENDING')
                                Menunggu Konfirmasi
                            @elseif($order->status == 'PROCESSING')
                                Sedang Diproses
                            @elseif($order->status == 'COMPLETED')
                                Selesai
                            @elseif($order->status == 'CANCELLED')
                                Dibatalkan
                            @else
                                {{ $order->status }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Order Details Grid -->
            <div class="p-4 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                                Informasi Pesanan
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-start">
                                    <span class="text-sm text-gray-600">Tanggal Pemesanan:</span>
                                    <span class="text-sm font-medium text-gray-900 text-right">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-sm text-gray-600">Metode Pembayaran:</span>
                                    <span class="inline-block px-3 py-1 rounded-full bg-blue-500 text-white text-xs font-semibold">
                                        {{ $order->payment_method }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-sm text-gray-600">Status Pembayaran:</span>
                                    <span class="inline-block px-3 py-1 rounded-full text-white text-xs font-semibold
                                        @if ($order->payment_status == 'PENDING') bg-yellow-500
                                        @elseif($order->payment_status == 'PAID') bg-green-600
                                        @else bg-gray-600 @endif">
                                        @if ($order->payment_status == 'PENDING')
                                            Belum Dibayar
                                        @elseif($order->payment_status == 'PAID')
                                            Sudah Dibayar
                                        @else
                                            {{ $order->payment_status }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-shipping-fast text-green-600 mr-2"></i>
                                Alamat Pengiriman
                            </h3>
                            <p class="text-sm text-gray-700 leading-relaxed">
                                {{ $order->shipping_address }}
                            </p>
                        </div>
                    </div>

                </div>

                <hr class="my-6 border-gray-200">

                <!-- Products Section -->
                <div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-shopping-bag text-gray-700 mr-2"></i>
                        Produk dalam Pesanan
                    </h3>

                    <!-- Desktop Table View -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr class="border-b">
                                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Produk</th>
                                    <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700">Jumlah</th>
                                    <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700">Harga</th>
                                    <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr class="border-b hover:bg-gray-50 transition">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center gap-3">
                                                @if($item->product->image)
                                                    <img src="{{ asset('storage/images/products/' . $item->product->image) }}" 
                                                         alt="{{ $item->product->name }}"
                                                         class="w-16 h-16 object-cover rounded-lg">
                                                @else
                                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                        <i class="fas fa-image text-gray-400"></i>
                                                    </div>
                                                @endif
                                                <span class="font-medium text-gray-900">{{ $item->product->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <span class="inline-block bg-gray-100 px-3 py-1 rounded-full text-sm font-semibold">
                                                {{ $item->qty }}x
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 text-center text-gray-700">
                                            Rp{{ number_format($item->price, 0, ',', '.') }}
                                        </td>
                                        <td class="py-4 px-4 text-center font-semibold text-gray-900">
                                            Rp{{ number_format($item->price * $item->qty, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="md:hidden space-y-3">
                        @foreach ($order->items as $item)
                            <div class="border rounded-lg p-4 bg-gray-50">
                                <div class="flex gap-3 mb-3">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/images/products/' . $item->product->image) }}" 
                                             alt="{{ $item->product->name }}"
                                             class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                                    @else
                                        <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 mb-2">{{ $item->product->name }}</h4>
                                        <p class="text-sm text-gray-600">
                                            Rp{{ number_format($item->price, 0, ',', '.') }} × {{ $item->qty }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center pt-3 border-t">
                                    <span class="text-sm text-gray-600">Subtotal:</span>
                                    <span class="font-bold text-gray-900">
                                        Rp{{ number_format($item->price * $item->qty, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

                <!-- Total Section -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="space-y-1">
                            <p class="text-sm text-gray-600">Total Item: <span class="font-semibold text-gray-900">{{ $order->items->sum('qty') }} produk</span></p>
                            <p class="text-sm text-gray-600">Ongkos Kirim: <span class="font-semibold text-gray-900">Rp0</span></p>
                        </div>
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-4 rounded-lg border-2 border-gray-200">
                            <p class="text-sm text-gray-600 mb-1">Total Pembayaran</p>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900">
                                Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Action Buttons (if needed) -->
        @if($order->status == 'COMPLETED')
            <div class="bg-green-50 border border-green-200 rounded-xl p-6 text-center">
                <i class="fas fa-check-circle text-green-600 text-4xl mb-3"></i>
                <h3 class="text-lg font-semibold text-green-900 mb-2">Pesanan Telah Selesai</h3>
                <p class="text-sm text-green-700 mb-4">Terima kasih telah berbelanja di toko kami!</p>
                <a href="{{ url('/products') }}" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                    Belanja Lagi
                </a>
            </div>
        @elseif($order->status == 'PENDING')
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center">
                <i class="fas fa-clock text-yellow-600 text-4xl mb-3"></i>
                <h3 class="text-lg font-semibold text-yellow-900 mb-2">Menunggu Konfirmasi</h3>
                <p class="text-sm text-yellow-700">Pesanan Anda sedang menunggu konfirmasi dari admin.</p>
            </div>
        @endif

    </div>
@endsection