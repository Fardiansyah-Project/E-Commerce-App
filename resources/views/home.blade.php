@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-5 py-10">
        {{-- Hero Banner --}}
        <div class="bg-white shadow rounded-2xl p-8 flex flex-col md:flex-row items-center mb-12">
            <div class="flex-1">
                <h1 class="text-4xl font-bold mb-4">Temukan Sepatu Impianmu</h1>
                <p class="text-gray-600 mb-6">
                    Koleksi sepatu terbaru, terlaris, dan rekomendasi khusus untukmu.
                </p>
                <a href="/products" class="bg-black text-white px-5 py-3 rounded-lg hover:bg-gray-800 transition">
                    Belanja Sekarang
                </a>
            </div>
            <div class="group">
                <img src="{{ asset('/images/hero-shoes.png')}}" class="w-80 lg:w-fit duration-1500 group-hover:-scale-x-95 gorup-hover:duration-500 ease-in-out drop-shadow-gray-700 drop-shadow-2xl">
            </div>
        </div>

        {{-- Produk Populer --}}
        <h2 class="text-2xl font-semibold mb-4">Produk Rekomendasi🔥</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($mostViewed as $product)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 hover:scale-110">
                    <img src="{{ asset('storage/images/products/' . $product->image) }}" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="font-semibold">{{ $product->name }}</h3>
                    <p class="text-gray-500">Rp{{ number_format($product->price) }}</p>

                    <a href="/product/{{ $product->slug }}"
                        class="block bg-black text-white text-center mt-3 py-2 rounded-lg hover:bg-gray-800">
                        Detail
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Produk Terlaris --}}
        <h2 class="text-2xl font-semibold mb-4 mt-3">Produk Terlaris🔥</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($bestSellers as $product)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 hover:scale-110">
                    <img src="{{ asset('storage/images/products/' . $product->image) }}" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="font-semibold">{{ $product->name }}</h3>
                    <p class="text-gray-500">Rp{{ number_format($product->price) }}</p>

                    <a href="/product/{{ $product->slug }}"
                        class="block bg-black text-white text-center mt-3 py-2 rounded-lg hover:bg-gray-800">
                        Detail
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
