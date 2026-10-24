<nav class="bg-slate-800 border-b border-slate-700 px-6 py-4 flex justify-between items-center">
    <a href="/" class="text-2xl font-bold text-indigo-400">DevCraft Studio</a>
    <div class="space-x-4">
        <a href="/" class="hover:text-indigo-400">Katalog Desain</a>
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 border border-indigo-500 rounded-lg">Log in</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 rounded-lg">Register</a>
            @endauth
        @endif
    </div>
</nav>