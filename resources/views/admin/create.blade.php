<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            Tambah Produk / Jasa Desain Baru
        </h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <form action="{{ route('desain.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Judul Produk / Desain</label>
                    <input type="text" name="judul" required class="w-full px-4 py-2 border rounded-xl text-sm focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kategori</label>
                    <select name="kategori_id" required class="w-full px-4 py-2 border rounded-xl text-sm">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->kategori_id }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Harga (Rp)</label>
                    <input type="number" name="harga" required class="w-full px-4 py-2 border rounded-xl text-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">URL Gambar (Unsplash / Online Image)</label>
                    <input type="url" name="gambar" required placeholder="https://images.unsplash.com/..." class="w-full px-4 py-2 border rounded-xl text-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border rounded-xl text-sm"></textarea>
                </div>

                <div class="pt-4 flex justify-end space-x-3">
                    <a href="{{ route('desain.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 text-xs font-bold rounded-xl">Batal</a>
                    <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>