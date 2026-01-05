@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-5 py-5">
        {{-- Produk Tesedia --}}
        <h2 class="text-2xl font-semibold mb-4">Produk Tersedia🙌</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4">
                    <div class="group">
                        <img src="{{ asset('storage/images/products/' . $product->image) }}"
                            class="w-full h-48 object-cover rounded-lg mb-4 duration-500 scale-50 md:scale-none group-hover:scale-150 group-hover:ease-in-out group-hover:duration-1000">
                    </div> 
                    <span class="text-slate-700 font-semibold text-sm sm:text-base"> {{ $product->category->name }} </span>
                    <h3 class="font-semibold">{{ $product->name }}</h3>
                    <p class="text-gray-500">Rp {{ number_format($product->price) }}</p>

                    <a href="/product/{{ $product->slug }}"
                        class="block bg-black text-white text-center mt-3 py-2 rounded-lg hover:bg-gray-800">
                        Detail
                    </a>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="qty" value="1">

                        @if (!empty($product->stock))  
                            <button
                                class="block bg-black text-white text-center mt-3 py-3 px-3 rounded-lg hover:bg-gray-800 hover:scale-90 hover:duration-100 hover:ease-in-out text-sm md:text-md">
                                <i class="fas fa-cart-plus"></i> Tambah ke keranjang
                            </button>
                        @else
                            <button
                                class="block bg-gray-400 text-white text-center mt-3 py-3 px-3 rounded-lg hover:bg-gray-800 hover:scale-90 hover:duration-100 hover:ease-in-out text-sm md:text-md"
                                disabled>
                                <i class="fas fa-cart-plus"></i> Tambah ke keranjang
                            </button>
                        @endif
                    </form>
                </div>
            @endforeach
        </div>
        <div class="mt-5">
            <a href="{{ url('/') }}"
                class=" bg-gray-500 text-white text-center mt-3 py-2 px-2 rounded-lg hover:bg-gray-700 text-sm md:text-md">
                <i class="fas fa-arrow-left"></i> Kembali ke beranda
            </a>
        </div>

    </div>
@endsection
{{-- <x-base-layout title="Home">
</x-base-layout> --}}
