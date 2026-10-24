<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevCraft Studio</title>

    <!-- Tailwind CSS CDN (Memastikan Style Tailwind Pasti Terload Sempurna) -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0F172A] min-h-screen text-slate-800 font-sans flex flex-col justify-between">

    <!-- Container Header Navigation -->
    <header class="w-full bg-[#8DA8C4] shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo Studio -->
            <a href="{{ route('home') }}" class="text-2xl font-black text-white tracking-wide">
                DevCraft <span class="text-slate-900">Studio</span>
            </a>
            
            <!-- Tab Navigasi Utama -->
            <div class="flex items-center space-x-6 text-sm font-semibold text-slate-900">
                <a href="{{ route('home') }}" class="hover:text-white transition {{ request()->routeIs('home') ? 'text-white font-bold' : '' }}">
                    Katalog
                </a>
                
                <a href="{{ route('cart') }}" class="hover:text-white transition flex items-center gap-1.5 {{ request()->routeIs('cart') ? 'text-white font-bold' : '' }}">
                    <span>Keranjang</span>
                    <span class="bg-slate-900 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                        {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
                    </span>
                </a>

                <a href="{{ route('checkout') }}" class="hover:text-white transition {{ request()->routeIs('checkout') ? 'text-white font-bold' : '' }}">
                    Checkout
                </a>

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
        </div>
    </header>

    <!-- Notifikasi Berhasil Tambah ke Keranjang -->
    @if(session('success'))
        <div class="bg-emerald-500 text-white text-center py-2.5 font-bold text-xs shadow-sm">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- Main Content Area -->
    <main class="w-full flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="w-full bg-[#0B1120] text-slate-400 py-6 text-center text-xs border-t border-slate-800 mt-12">
        <p>&copy; 2026 DevCraft Studio. All rights reserved.</p>
    </footer>

</body>
</html>