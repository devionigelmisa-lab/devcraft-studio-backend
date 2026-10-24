<x-home-layout>
    <!-- Banner Hero & Search Filter -->
    <section class="bg-[#DCE7F0] py-14 px-6 text-center w-full">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
                Solusi Desain Praktis untuk Tugas, Bisnis, & Kontenmu!
            </h1>
            <p class="text-slate-600 mt-3 text-sm max-w-xl mx-auto">
                Template desain siap pakai atau mau pesan jasa desain kustom? Semua ada di sini untuk wujudkan ide kreatifmu.
            </p>
            
            <form action="{{ route('home') }}" method="GET" class="mt-8 flex flex-col sm:flex-row justify-center gap-3 max-w-2xl mx-auto">
                <input type="text" name="s" value="{{ request('s') }}" placeholder="Cari produk atau desain..." class="w-full px-5 py-2.5 border border-slate-300 rounded-xl text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-slate-800 bg-white">
                <select name="id_kategori" onchange="this.form.submit()" class="px-4 py-2.5 border border-slate-300 rounded-xl text-sm text-slate-700 bg-white shadow-sm focus:outline-none">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->kategori_id }}" {{ request('id_kategori') == $kat->kategori_id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </section>

    <!-- Section Grid Products -->
    <section class="max-w-7xl mx-auto py-12 px-6">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-white">Trending Products</h2>
            <p class="text-sm text-slate-400">Produk digital siap pakai langsung download.</p>
        </div>

        <!-- Grid 3 Kolom Responsif -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $item)
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden p-4 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <!-- Thumbnail Image -->
                        <div class="relative mb-3 w-full h-52 bg-slate-100 rounded-xl overflow-hidden">
                            <img src="{{ $item->gambar }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                            <span class="absolute top-3 right-3 bg-[#0F172A] text-white text-[10px] px-2.5 py-1 rounded-lg font-bold uppercase tracking-wider">
                                PRODUCT
                            </span>
                        </div>
                        
                        <span class="inline-block text-[11px] font-bold text-sky-600 bg-sky-50 px-3 py-1 rounded-full border border-sky-100 mb-1">
                            {{ $item->kategori->nama_kategori ?? 'General' }}
                        </span>
                        
                        <h3 class="text-base font-bold text-slate-900 leading-snug mt-1">{{ $item->judul }}</h3>
                    </div>

                    <div class="mt-5">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs text-amber-500 font-bold">★ 4.9</span>
                            <span class="text-slate-900 font-extrabold text-base">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="grid grid-cols-3 gap-2">
                            <!-- Tombol Lihat Detail -->
                            <a href="{{ route('product.detail', $item->desain_id) }}" class="col-span-2 text-center py-2.5 bg-[#2B75B1] hover:bg-[#112A46] text-white font-bold text-xs rounded-xl transition flex items-center justify-center">
                                Lihat Detail
                            </a>

                            <!-- Form Tambah ke Keranjang -->
                            <form action="{{ route('cart.add', $item->desain_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-2.5 bg-[#25A174] hover:bg-emerald-700 text-white font-bold text-xs rounded-xl transition">
                                    + Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-3 text-center py-12 text-slate-400">
                    Belum ada produk atau template yang tersedia.
                </div>
            @endforelse
        </div>
    </section>
</x-home-layout>