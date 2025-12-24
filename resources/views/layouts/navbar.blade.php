<nav class="bg-transparent backdrop-blur-md shadow sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="/" class="font-bold text-2xl text-gray-800">SneakerStore</a>

        <div class="hidden md:flex items-center space-x-7">
            <a href="/"
                class="{{ request()->is('/') ? 'text-gray-800 font-semibold' : 'text-gray-600' }} hover:text-black">
                <i class="fas fa-home"></i>
            </a>
            <a href="{{ url('/products') }}"
                class="{{ request()->is('products') ? 'text-gray-800 font-semibold' : 'text-gray-600' }} hover:text-black">
                <i class="fas fa-box"></i>
            </a>
            <a href="{{ url('/orders') }}"
                class="{{ request()->is('orders') ? 'text-gray-800 font-semibold' : 'text-gray-600' }} hover:text-black">
                <i class="fas fa-truck"></i>
            </a>
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
                <a href="{{ url('orders/order/trashed') }}"
                    class="{{ request()->is('orders/order/trashed') ? 'text-gray-800 font-semibold' : 'text-gray-600' }} hover:text-black">
                    <i class="fas fa-history"></i>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline-block">
                    @csrf
                    <button class="text-red-400 hover:text-black">
                       Keluar <i class="fas fa-sign-out-alt"></i> 
                    </button>
                </form>
            @else
                <a href="/login" class="text-gray-600 hover:text-black">
                    Masuk <i class="fas fa-sign-in-alt"></i> 
                </a>
            @endauth
        </div>
    </div>
</nav>
