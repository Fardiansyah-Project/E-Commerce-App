@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 sm:px-5 py-6 sm:py-10">

        <h2 class="text-2xl sm:text-3xl font-semibold mb-4 sm:mb-6">Keranjang Belanja</h2>

        @if (!$cart || $cart->items->isEmpty())
            <div class="bg-white p-8 rounded-xl shadow text-center">
                <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <p class="text-gray-500 text-lg">Keranjangmu kosong.</p>
                <a href="{{ url('/products') }}"
                    class="inline-block mt-4 bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800">
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
                                <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Foto</th>
                                <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Produk</th>
                                <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Jumlah</th>
                                <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Harga</th>
                                <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Total</th>
                                <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart->items as $item)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="py-4 px-6">
                                        <img class="w-20 h-20 object-cover rounded-lg"
                                            src="{{ asset('storage/images/products/' . $item->product->image) }}"
                                            alt="{{ $item->product->name }}">
                                    </td>
                                    <td class="py-4 px-6">
                                        <p class="font-medium text-gray-900">{{ $item->product->name }}</p>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-center">
                                            <form method="POST" action="{{ route('cart.decrease', $item->id) }}">
                                                @csrf
                                                <button type="submit"
                                                    class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded-l transition">-</button>
                                            </form>
                                            <span
                                                class="px-4 py-1 border-t border-b min-w-[50px] text-center">{{ $item->qty }}</span>
                                            <form method="POST" action="{{ route('cart.increase', $item->id) }}">
                                                @csrf
                                                <button type="submit"
                                                    class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded-r transition">+</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center text-gray-700">
                                        Rp {{ number_format($item->price_snapshot, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 px-6 text-center font-semibold text-gray-900">
                                        Rp {{ number_format($item->price_snapshot * $item->qty, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex flex-col gap-2">
                                            <a href="{{ url('product/' . $item->product->slug) }}"
                                                class="bg-black text-white text-center text-sm py-2 px-4 rounded-lg hover:bg-gray-800 transition">
                                                Detail
                                            </a>
                                            <form method="POST" action="/cart/remove/{{ $item->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-full bg-red-600 text-white text-center text-sm py-2 px-4 rounded-lg hover:bg-red-700 transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="lg:hidden p-4 space-y-4">
                    @foreach ($cart->items as $item)
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <!-- Product Image & Name -->
                            <div class="flex gap-4 mb-4">
                                <img class="w-20 h-20 sm:w-24 sm:h-24 object-cover rounded-lg flex-shrink-0"
                                    src="{{ asset('storage/images/products/' . $item->product->image) }}"
                                    alt="{{ $item->product->name }}">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-2">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-600">
                                        Harga: <span class="font-medium">Rp
                                            {{ number_format($item->price_snapshot, 0, ',', '.') }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Quantity Controls -->
                            <div class="flex items-center justify-between mb-4 pb-4 border-b">
                                <span class="text-sm text-gray-600">Jumlah:</span>
                                <div class="flex items-center">
                                    <form method="POST" action="{{ route('cart.decrease', $item->id) }}">
                                        @csrf
                                        <button type="submit"
                                            class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded-l transition">-</button>
                                    </form>
                                    <span
                                        class="px-4 py-1 border-t border-b min-w-[50px] text-center font-medium">{{ $item->qty }}</span>
                                    <form method="POST" action="{{ route('cart.increase', $item->id) }}">
                                        @csrf
                                        <button type="submit"
                                            class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded-r transition">+</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Total Price -->
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-sm text-gray-600">Total:</span>
                                <span class="text-lg font-bold text-gray-900">
                                    Rp {{ number_format($item->price_snapshot * $item->qty, 0, ',', '.') }}
                                </span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ url('product/' . $item->product->slug) }}"
                                    class="bg-black text-white text-center text-sm py-2 px-4 rounded-lg hover:bg-gray-800 transition">
                                    Detail
                                </a>
                                <form method="POST" action="/cart/remove/{{ $item->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full bg-red-600 text-white text-center text-sm py-2 px-4 rounded-lg hover:bg-red-700 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Cart Summary -->
                <div class="border-t bg-gray-50 p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <!-- Total -->
                        <div class="order-2 sm:order-1">
                            <p class="text-sm text-gray-600 mb-1">Total Pembayaran:</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-900">
                                Rp
                                {{ number_format($cart->items->sum(fn($i) => $i->price_snapshot * $i->qty), 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Checkout Button -->
                        <div class="order-1 sm:order-2">
                            <a href="{{ url('/checkout') }}"
                                class="block w-full sm:w-auto bg-black text-white text-center px-8 py-3 rounded-lg hover:bg-gray-800 transition font-medium">
                                Lanjut ke Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
