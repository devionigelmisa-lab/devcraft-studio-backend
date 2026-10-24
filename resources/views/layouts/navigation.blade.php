<nav class="bg-[#8DA8C4] px-8 py-4 flex justify-between items-center shadow-md w-full">
    <!-- Logo Studio -->
    <a href="{{ route('home') }}" class="text-2xl font-black text-white tracking-wide flex items-center gap-1">
        DevCraft <span class="text-slate-900">Studio</span>
    </a>
    
    <!-- Tab Navigasi Utama -->
    <div class="flex items-center space-x-6 text-sm font-semibold text-slate-900">
        <a href="{{ route('home') }}" class="hover:text-white transition {{ request()->routeIs('home') ? 'text-white font-bold' : '' }}">
            Katalog
        </a>
        
        <!-- Tab Keranjang dengan Counter Real-Time -->
        <a href="{{ route('cart') }}" class="hover:text-white transition flex items-center gap-1.5 {{ request()->routeIs('cart') ? 'text-white font-bold' : '' }}">
            <span>Keranjang</span>
            <span class="bg-slate-900 text-white text-xs font-bold px-2.5 py-0.5 rounded-full">
                {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
            </span>
        </a>

        <!-- Tab Checkout -->
        <a href="{{ route('checkout') }}" class="hover:text-white transition {{ request()->routeIs('checkout') ? 'text-white font-bold' : '' }}">
            Checkout
        </a>

        <!-- Tombol Auth / Admin Panel -->
        @if (Route::has('login'))
            @auth
                <a href="{{ route('dashboard') }}" class="bg-[#0F172A] hover:bg-slate-800 text-white px-5 py-2 rounded-xl text-sm font-bold shadow transition">
                    Admin Panel
                </a>
            @else
                <a href="{{ route('login') }}" class="hover:text-white transition">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-[#0F172A] hover:bg-slate-800 text-white px-4 py-2 rounded-xl text-sm font-bold shadow transition">
                        Register
                    </a>
                @endif
            @endauth
        @endif
    </div>
</nav>