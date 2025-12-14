<nav class="bg-transparent backdrop-blur-md shadow sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="/" class="font-bold text-2xl text-gray-800">SneakerStore</a>

        <div class="hidden md:flex items-center space-x-6">
            <a href="/"
                class="{{ request()->is('/') ? 'text-gray-800 font-semibold' : 'text-gray-600' }} hover:text-black">Home</a>
            <a href="/products"
                class="{{ request()->is('products') ? 'text-gray-800 font-semibold' : 'text-gray-600' }} hover:text-black">Produk</a>
            <a href="/orders"
                class="{{ request()->is('orders') ? 'text-gray-800 font-semibold' : 'text-gray-600' }} hover:text-black">Pesanan</a>
            <a href="/orders-trashed"
                class="{{ request()->is('orders-trashed') ? 'text-gray-800 font-semibold' : 'text-gray-600' }} hover:text-black">Riwayat</a>

            @auth
                <a href="/cart" class="relative">
                    <span
                        class="{{ request()->is('cart') ? 'text-gray-800 font-bold' : 'text-gray-600' }} hover:text-black">
                        <i class="fas fa-shopping-cart"></i>
                    </span>
                    <span class="absolute -top-2 -right-3 bg-red-600 text-white text-xs px-1 rounded">
                        {{ optional(optional(auth()->user())->cart)->items ? optional(optional(auth()->user())->cart->items)->sum('qty') : 0 }}
                    </span>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline-block">
                    @csrf
                    <button class="text-gray-600 hover:text-black">Logout</button>
                </form>
            @else
                <a href="/login" class="text-gray-600 hover:text-black">Login</a>
            @endauth
        </div>
    </div>
</nav>
