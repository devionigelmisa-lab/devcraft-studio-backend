<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                DevCraft Admin Panel - Kelola Produk & Desain
            </h2>
            <a href="{{ route('desain.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2 rounded-xl text-sm shadow">
                + Tambah Produk Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white overflow-x-auto shadow-sm rounded-2xl border border-slate-200 p-6">
            <table class="w-full text-left border-collapse table-auto">
                <thead>
                    <tr class="border-b border-slate-200 text-xs font-bold text-slate-500 uppercase bg-slate-50">
                        <th class="p-3 w-28">Preview</th>
                        <th class="p-3">Judul Produk</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($desains as $item)
                        <tr class="hover:bg-slate-50 transition">
                            <!-- Gambar Dibatasi Ukurannya (w-20 h-16) -->
                            <td class="p-3">
                                <img src="{{ $item->gambar }}" class="w-20 h-16 object-cover rounded-lg border shadow-sm">
                            </td>
                            <td class="p-3 font-bold text-slate-800">{{ $item->judul }}</td>
                            <td class="p-3">
                                <span class="bg-sky-50 text-sky-600 font-bold text-xs px-2.5 py-1 rounded-full border border-sky-100">
                                    {{ $item->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>
                            <td class="p-3 font-extrabold text-slate-900">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>
                            <td class="p-3 text-right space-x-2">
                                <a href="{{ route('desain.edit', $item->desain_id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold text-xs bg-indigo-50 px-3 py-1.5 rounded-lg border border-indigo-100">
                                    Edit
                                </a>
                                <form action="{{ route('desain.destroy', $item->desain_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" class="text-red-600 hover:text-red-900 font-bold text-xs bg-red-50 px-3 py-1.5 rounded-lg border border-red-100">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-slate-400">Belum ada data produk di database.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $desains->links() }}
            </div>
        </div>
    </div>
</x-app-layout>