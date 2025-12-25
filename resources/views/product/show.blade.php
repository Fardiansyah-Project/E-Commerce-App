@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-5 py-6 sm:py-10">

        <!-- Breadcrumb -->
        <nav class="flex mb-4 sm:mb-6 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ url('/') }}" class="text-gray-600 hover:text-black transition">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <a href="{{ url('/products') }}" class="text-gray-600 hover:text-black transition">
                            Products
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-gray-900 font-medium">{{ Str::limit($product->name, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Product Detail Card -->
        <div class="bg-white shadow-xl rounded-2xl sm:rounded-3xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">

                <!-- Product Image Section -->
                <div class="p-6 sm:p-8 lg:p-12 bg-gradient-to-br from-gray-50 to-gray-100">
                    <div class="product-image-container mb-6">
                        <img src="{{ asset('storage/images/products/' . $product->image) }}" alt="{{ $product->name }}"
                            class="product-image w-full h-64 sm:h-80 lg:h-96 object-cover">
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="qty" value="1">

                            @if ($product->stock > 0)
                                <button type="submit"
                                    class="w-full bg-black text-white py-3 sm:py-4 px-6 rounded-lg hover:bg-gray-800 transition transform hover:scale-105 font-medium text-sm sm:text-base shadow-lg">
                                    <i class="fas fa-cart-plus mr-2"></i> Tambah ke Keranjang
                                </button>
                            @else
                                <button type="button" disabled
                                    class="w-full bg-gray-400 text-white py-3 sm:py-4 px-6 rounded-lg cursor-not-allowed font-medium text-sm sm:text-base">
                                    <i class="fas fa-times-circle mr-2"></i> Stok Habis
                                </button>
                            @endif
                        </form>

                        <a href="{{ url('products') }}"
                            class="block w-full bg-gray-500 text-white text-center py-3 sm:py-4 px-6 rounded-lg hover:bg-gray-700 transition font-medium text-sm sm:text-base">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Produk
                        </a>
                    </div>
                </div>

                <!-- Product Info Section -->
                <div class="p-6 sm:p-8 lg:p-12">

                    <!-- Product Title & Badges -->
                    <div class="mb-6">
                        <div class="flex flex-wrap gap-2 mb-3">
                            @if ($product->stock > 0)
                                <span
                                    class="badge-animated bg-green-500 text-white text-xs px-3 py-1 rounded-full font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i> Tersedia
                                </span>
                            @else
                                <span class="bg-red-500 text-white text-xs px-3 py-1 rounded-full font-semibold">
                                    <i class="fas fa-times-circle mr-1"></i> Stok Habis
                                </span>
                            @endif

                            @if ($product->sale_price)
                                <span
                                    class="badge-animated bg-red-500 text-white text-xs px-3 py-1 rounded-full font-semibold">
                                    <i class="fas fa-tag mr-1"></i> SALE
                                </span>
                            @endif
                        </div>

                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                            {{ $product->name }}
                        </h1>

                        <!-- Price -->
                        <div class="mb-4">
                            @if ($product->sale_price)
                                <div class="flex items-center gap-3 flex-wrap">
                                    <span class="text-3xl sm:text-4xl font-bold text-red-600">
                                        Rp{{ number_format($product->sale_price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-xl text-gray-500 line-through">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    <span class="bg-red-100 text-red-600 text-sm px-3 py-1 rounded-full font-semibold">
                                        {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                                        OFF
                                    </span>
                                </div>
                            @else
                                <span class="text-3xl sm:text-4xl font-bold text-gray-900">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div class="mb-6 pb-6 border-b">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi Produk</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $product->description ?: 'Tidak ada deskripsi untuk produk ini.' }}
                        </p>
                    </div>

                    <!-- Product Details -->
                    <div class="space-y-3">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Produk</h3>

                        <div class="info-item flex items-center justify-between p-3 rounded-lg">
                            <span class="text-gray-600 flex items-center">
                                <i class="fas fa-box text-gray-400 mr-3 w-5"></i>
                                Stok Tersedia
                            </span>
                            <span class="font-semibold text-gray-900">{{ $product->stock }} unit</span>
                        </div>

                        <div class="info-item flex items-center justify-between p-3 rounded-lg">
                            <span class="text-gray-600 flex items-center">
                                <i class="fas fa-eye text-gray-400 mr-3 w-5"></i>
                                Dilihat
                            </span>
                            <span class="font-semibold text-gray-900">{{ number_format($product->views) }}x</span>
                        </div>

                        <div class="info-item flex items-center justify-between p-3 rounded-lg">
                            <span class="text-gray-600 flex items-center">
                                <i class="fas fa-shopping-bag text-gray-400 mr-3 w-5"></i>
                                Terjual
                            </span>
                            <span class="font-semibold text-gray-900">
                                {{ $product->orderItems()->whereHas('order', function ($order) {
                                        $order->whereIn('status', ['COMPLETED']);
                                    })->sum('qty') }}
                                unit
                            </span>
                        </div>

                        <div class="info-item flex items-center justify-between p-3 rounded-lg">
                            <span class="text-gray-600 flex items-center">
                                <i class="fas fa-calendar-alt text-gray-400 mr-3 w-5"></i>
                                Ditambahkan
                            </span>
                            <span class="font-semibold text-gray-900">{{ $product->created_at->format('d F Y') }}</span>
                        </div>
                    </div>

                    <!-- Share Section (Optional) -->
                    <div class="mt-8 pt-6 border-t">
                        @php
                        @endphp
                        <h3 class="text-sm font-semibold text-gray-600 mb-3">Bagikan Produk:</h3>
                        <div class="flex gap-2">
                            <a href="{{ $rawLinks['facebook'] }}" target="_blank"
                                class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition w-10 h-10 flex items-center justify-center">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="{{ $rawLinks['twitter'] }}" target="_blank"
                                class="bg-blue-400 text-white p-2 rounded-lg hover:bg-blue-500 transition w-10 h-10 flex items-center justify-center">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="{{ $rawLinks['whatsapp'] }}" target="_blank"
                                class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition w-10 h-10 flex items-center justify-center">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <button onclick="copyLink()"
                                class="bg-gray-600 text-white p-2 rounded-lg hover:bg-gray-700 transition w-10 h-10 flex items-center justify-center">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Related Products or Additional Info (Optional) -->
        <div class="mt-8 sm:mt-12">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4">Informasi Tambahan</h2>
            <div class="bg-white shadow-lg rounded-xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-truck text-blue-600 text-2xl"></i>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Gratis Ongkir</h4>
                            <p class="text-sm text-gray-600">Untuk pembelian minimal Rp500.000</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Garansi 100%</h4>
                            <p class="text-sm text-gray-600">Produk original dan bergaransi</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-undo text-orange-600 text-2xl"></i>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Easy Return</h4>
                            <p class="text-sm text-gray-600">Pengembalian mudah dalam 7 hari</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function copyLink() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                alert('Link berhasil disalin!');
            });
        }
    </script>
@endsection
