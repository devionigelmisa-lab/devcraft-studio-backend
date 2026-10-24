<x-home-layout>
    <div class="max-w-6xl mx-auto py-10 px-6">
        <!-- Main Product Detail Card -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <!-- Product Preview Image -->
            <div>
                <img src="{{ $product->gambar }}" alt="{{ $product->judul }}" class="w-full h-80 object-cover rounded-2xl border">
            </div>

            <!-- Product Meta & Actions -->
            <div class="space-y-4">
                <span class="inline-block text-xs font-bold text-sky-600 bg-sky-50 px-3 py-1 rounded-full border border-sky-100">
                    {{ $product->kategori->nama_kategori ?? 'General' }}
                </span>

                <h1 class="text-3xl font-black text-slate-900 tracking-tight leading-snug">
                    {{ $product->judul }}
                </h1>

                <p class="text-slate-600 text-sm leading-relaxed">
                    {{ $product->deskripsi ?? 'Template desain aesthetic & fully editable untuk feeds promosi produk atau personal branding.' }}
                </p>

                <div class="pt-2">
                    <span class="text-2xl font-black text-slate-900 block">
                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                    </span>
                </div>

                <div class="pt-4">
                    <form action="{{ route('cart.add', $product->desain_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-3.5 bg-[#2B75B1] hover:bg-[#112A46] text-white font-bold text-sm rounded-xl transition shadow">
                            + Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Section Ulasan Pengguna -->
        <div class="mt-8 bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Ulasan Pengguna</h3>
            <div class="space-y-4">
                <textarea placeholder="Tulis ulasan kamu di sini..." class="w-full p-4 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-800"></textarea>
                <button class="px-6 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl transition">
                    Kirim Ulasan
                </button>
            </div>
        </div>
    </div>
</x-home-layout>