@extends('layouts.app')

@section('content')
    <style>

    </style>

    <div class="container mx-auto px-4 sm:px-5 py-6 sm:py-10">

        {{-- Hero Banner --}}
        <div
            class="bg-gradient-to-br from-gray-50 to-gray-100 shadow-xl rounded-2xl sm:rounded-3xl p-6 sm:p-8 lg:p-12 flex flex-col md:flex-row items-center gap-6 lg:gap-8 mb-8 sm:mb-12 overflow-hidden">
            <div class="flex-1 text-center md:text-left order-2 md:order-1">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-3 sm:mb-4 text-gray-900 leading-tight">
                    Temukan Sepatu<br class="hidden sm:block"> Impianmu
                </h1>
                <p class="text-gray-600 mb-4 sm:mb-6 text-sm sm:text-base lg:text-lg">
                    Koleksi sepatu terbaru, terlaris, dan rekomendasi khusus untukmu.
                </p>
                <a href="/products"
                    class="inline-block bg-black text-white px-6 sm:px-8 py-3 rounded-lg hover:bg-gray-800 transition transform hover:scale-105 font-medium text-sm sm:text-base shadow-lg">
                    Belanja Sekarang →
                </a>
            </div>

            <div class="order-1 md:order-2 flex justify-center md:justify-end w-full md:w-auto">
                <img src="{{ asset('/images/hero-shoes.png') }}" alt="Hero Shoes"
                    class="hero-shoe-animated w-64 sm:w-80 lg:w-96 max-w-full drop-shadow-2xl cursor-pointer">
            </div>
        </div>

        {{-- Produk Rekomendasi --}}
        <section class="mb-8 sm:mb-12">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">
                    Produk Rekomendasi 🔥
                </h2>
                <a href="/products" class="text-sm sm:text-base text-gray-600 hover:text-black transition hidden sm:block">
                    Lihat Semua →
                </a>
            </div>

            @if ($mostViewed->isEmpty())
                <div class="text-center py-12 bg-gray-50 rounded-xl">
                    <p class="text-gray-500">Belum ada produk rekomendasi</p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">
                    @foreach ($mostViewed as $product)
                        <div
                            class="product-card-wrapper bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="product-card-content p-3 sm:p-4">
                                <div class="relative overflow-hidden rounded-lg mb-3 sm:mb-4 bg-gray-100 group">
                                    <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-32 sm:h-48 lg:h-52 object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div
                                        class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full font-semibold">
                                        HOT
                                    </div>
                                </div>

                                <h3
                                    class="font-semibold text-sm sm:text-base lg:text-lg text-gray-900 mb-1 sm:mb-2 line-clamp-2 min-h-[40px] sm:min-h-[48px]">
                                    {{ $product->name }}
                                </h3>
                                <span class="text-slate-700 font-semibold text-sm sm:text-base">
                                    {{ $product->category->name }} </span>
                                <p class="text-gray-900 font-bold text-sm sm:text-base lg:text-lg mb-2 sm:mb-3">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </p>

                                <a href="/product/{{ $product->slug }}"
                                    class="block bg-black text-white text-center text-xs sm:text-sm py-2 sm:py-2.5 rounded-lg hover:bg-gray-800 transition transform hover:scale-105 font-medium">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Mobile "Lihat Semua" -->
            <a href="/products" class="block sm:hidden text-center mt-4 text-gray-600 hover:text-black transition">
                Lihat Semua Produk →
            </a>
        </section>

        {{-- Produk Terlaris --}}
        <section class="mb-8 sm:mb-12">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">
                    Produk Terlaris 🔥
                </h2>
                <a href="/products" class="text-sm sm:text-base text-gray-600 hover:text-black transition hidden sm:block">
                    Lihat Semua →
                </a>
            </div>

            @if ($bestSellers->isEmpty())
                <div class="text-center py-12 bg-gray-50 rounded-xl">
                    <p class="text-gray-500">Belum ada produk terlaris</p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">
                    @foreach ($bestSellers as $product)
                        <div
                            class="product-card-wrapper bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="product-card-content p-3 sm:p-4">
                                <div class="relative overflow-hidden rounded-lg mb-3 sm:mb-4 bg-gray-100 group">
                                    <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-32 sm:h-48 lg:h-52 object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div
                                        class="absolute top-2 right-2 bg-yellow-500 text-white text-xs px-2 py-1 rounded-full font-semibold">
                                        BEST
                                    </div>
                                </div>

                                <h3
                                    class="font-semibold text-sm sm:text-base lg:text-lg text-gray-900 mb-1 sm:mb-2 line-clamp-2 min-h-[40px] sm:min-h-[48px]">
                                    {{ $product->name }}
                                </h3>
                                <span class="text-slate-700 font-semibold text-sm sm:text-base">
                                    {{ $product->category->name }} </span>
                                <p class="text-gray-900 font-bold text-sm sm:text-base lg:text-lg mb-2 sm:mb-3">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </p>

                                <a href="/product/{{ $product->slug }}"
                                    class="block bg-black text-white text-center text-xs sm:text-sm py-2 sm:py-2.5 rounded-lg hover:bg-gray-800 transition transform hover:scale-105 font-medium">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Mobile "Lihat Semua" -->
            <a href="/products" class="block sm:hidden text-center mt-4 text-gray-600 hover:text-black transition">
                Lihat Semua Produk →
            </a>
        </section>

    </div>
@endsection
