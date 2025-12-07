@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-5 py-10">
        <div class="flex flex-wrap justify-center items-center">
            <div class="bg-white shadow rounded-2xl p-8 flex flex-col md:flex-row gap-0 md:gap-5 items-center justify-center w-full md:w-1/2">
                <div class="flex flex-col-reverse md:flex-col">
                    <div class="group">
                        <img src="{{ asset('storage/images/products/' . $product->image) }}" class="w-full h-48 object-cover rounded-lg mb-4 duration-200 group-hover:scale-x-50 group-hover:duration-150 hover:ease-in-out">
                    </div>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="qty" value="1">
                        @if (!empty($product->stock))
                            <button
                            class="block bg-black text-white text-center mt-3 py-3 px-3 rounded-lg hover:bg-gray-800 text-sm md:text-md">
                            <i class="fas fa-cart-plus"></i> Tambah ke keranjang
                        </button>
                        @endif
                        <a href="{{ url('products') }}" class="block bg-gray-500 text-white text-center mt-3 py-3 px-3 rounded-lg hover:bg-gray-700 text-sm md:text-md">
                            <i class="fas fa-arrow-left"></i> Kembali ke produk
                        </a>
                    </form>
                </div>
                <div class="flex flex-col">
                    <h1 class="font-bold">{{ $product->name }}</h1>
                    <p class="text-gray-700 font-semibold">Harga: Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    @if ($product->sale_price)
                        <p class="text-gray-700 font-semibold">Harga Diskon:
                            Rp{{ number_format($product->sale_price, 0, ',', '.') }}</p>
                    @endif
                    <p class="text-gray-700 font-semibold">Stok: {{ $product->stock }}</p>
                    <p class="text-gray-700 font-semibold">Deskripsi: {{ $product->description }}</p>
                    <p class="text-gray-700 font-semibold">Dilihat: {{ $product->views }}</p>
                    <p class="text-gray-700 font-semibold">Ditambahkan: {{ $product->created_at->format('d F Y') }}</p>
                    <p class="text-gray-700 font-semibold">Terjual: {{ $product->orderItems()->sum('qty') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
