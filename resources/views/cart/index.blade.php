@extends('layouts.app')
@section('content')
    {{-- <div class="container">
        <h2>Keranjang</h2>

        @if (!$cart || $cart->items->isEmpty())
            <p>Keranjang kosong.</p>
        @else
            <table class="table">
                @foreach ($cart->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp {{ number_format($item->price_snapshot) }}</td>
                    </tr>
                @endforeach
            </table>

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <textarea name="address" class="form-control mb-2" placeholder="Alamat Pengiriman"></textarea>
                <select name="payment_method" class="form-control mb-2">
                    <option value="COD">COD</option>
                    <option value="TRANSFER">Transfer Manual</option>
                </select>
                <button class="btn btn-primary">Checkout</button>
            </form>
        @endif

    </div> --}}
    {{-- <div class="container mx-auto px-5 py-10">

        <h2 class="text-3xl font-semibold mb-6">Keranjang Belanja</h2>

        @if (!$cart || $cart->items->isEmpty())
            <p class="text-gray-500">Keranjangmu kosong.</p>
        @else
            <div class="bg-white p-6 rounded-xl shadow">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 text-left">Produk</th>
                            <th class="py-2">Jumlah</th>
                            <th class="py-2">Harga</th>
                            <th class="py-2">Total</th>
                            <th class="py-2">Aksi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart->items as $item)
                            <tr class="border-b">
                                <td class="py-3">{{ $item->product->name }}</td>
                                <td class="text-center">{{ $item->qty }}</td>
                                <td class="text-center">Rp {{ number_format($item->price_snapshot) }}</td>
                                <td class="text-center">Rp {{ number_format($item->price_snapshot * $item->qty) }}</td>
                                <td>
                                    <form method="POST" action="/cart/remove/{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                    <a href="{{ url('/product/' . $item->product->slug) }}"
                                        class="block bg-black text-white text-center mt-3 py-2 rounded-lg hover:bg-gray-800">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right mt-5 flex">
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <a href="{{ url('/checkout')}}" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800">
                            Checkout
                        </a>
                    </form>
                    <p class="ml-4 self-center">Total pembayaran: Rp{{ number_format($cart->items->sum(fn($item) => $item->price_snapshot * $item->qty)) }}</p>
                </div>
            </div>
        @endif

    </div> --}}
    <div class="container mx-auto px-5 py-10">

        <h2 class="text-3xl font-semibold mb-6">Keranjang Belanja</h2>

        @if (!$cart || $cart->items->isEmpty())
            <p class="text-gray-500">Keranjangmu kosong.</p>
        @else
            <div class="bg-white p-6 rounded-xl shadow">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 text-left">Produk</th>
                            <th class="py-2 text-center">Jumlah</th>
                            <th class="py-2 text-center">Harga</th>
                            <th class="py-2 text-center">Total</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart->items as $item)
                            <tr class="border-b">
                                <td class="py-3">{{ $item->product->name }}</td>

                                {{-- Qty With + & - --}}
                                <td class="text-center">
                                    <div class="flex items-center justify-center">

                                        {{-- Kurangi --}}
                                        <form method="POST" action="{{ route('cart.decrease', $item->id) }}">
                                            @csrf
                                            <button class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded-l">-</button>
                                        </form>

                                        <span class="px-4 py-1 border">{{ $item->qty }}</span>

                                        {{-- Tambah --}}
                                        <form method="POST" action="{{ route('cart.increase', $item->id) }}">
                                            @csrf
                                            <button class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded-r">+</button>
                                        </form>

                                    </div>
                                </td>

                                <td class="text-center">Rp {{ number_format($item->price_snapshot) }}</td>
                                <td class="text-center">Rp {{ number_format($item->price_snapshot * $item->qty) }}</td>

                                <td>
                                    <form method="POST" action="/cart/remove/{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>

                                    <a href="{{ url('/product/' . $item->product->slug) }}"
                                        class="block bg-black text-white text-center mt-3 py-2 rounded-lg hover:bg-gray-800">
                                        Detail
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right mt-5 flex">
                    <a href="{{ url('/checkout') }}" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800">
                        Checkout
                    </a>

                    <p class="ml-4 self-center">
                        Total pembayaran:
                        <strong>Rp {{ number_format($cart->items->sum(fn($i) => $i->price_snapshot * $i->qty)) }}</strong>
                    </p>
                </div>
            </div>
        @endif

    </div>

@endsection
