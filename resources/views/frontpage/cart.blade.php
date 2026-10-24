<x-home-layout>
    <div class="max-w-5xl mx-auto py-12 px-6">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-6 text-center">Keranjang Belanja Kamu</h1>
        
        <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
            @if(session('cart') && count(session('cart')) > 0)
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b text-xs font-bold text-slate-400 uppercase">
                            <th class="py-3">Produk</th>
                            <th class="py-3">Jumlah</th>
                            <th class="py-3">Harga</th>
                            <th class="py-3 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y text-sm">
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $id => $details)
                            @php $subtotal = $details['price'] * $details['quantity']; $total += $subtotal; @endphp
                            <tr>
                                <td class="py-4 font-bold text-slate-800 flex items-center gap-3">
                                    <img src="{{ $details['image'] }}" class="w-12 h-10 object-cover rounded-lg border">
                                    <span>{{ $details['title'] }}</span>
                                </td>
                                <td class="py-4 font-semibold text-slate-600">{{ $details['quantity'] }}x</td>
                                <td class="py-4 text-slate-600">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                <td class="py-4 text-right font-extrabold text-slate-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-8 flex justify-between items-center pt-6 border-t border-slate-100">
                    <a href="{{ route('home') }}" class="text-sm font-bold text-slate-600 hover:text-slate-900">
                        ← Lanjut Belanja
                    </a>
                    
                    <div class="text-right">
                        <span class="text-xs text-slate-500 block mb-1">Total Pembayaran:</span>
                        <span class="text-2xl font-black text-slate-900 block mb-4">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        <a href="{{ route('checkout') }}" class="inline-block px-6 py-3 bg-[#25A174] hover:bg-emerald-700 text-white font-bold text-sm rounded-xl transition shadow">
                            Lanjut ke Checkout →
                        </a>
                    </div>
                </div>
            @else
                <div class="text-center py-12 text-slate-400">
                    <p class="mb-4 text-sm font-semibold">Keranjang belanja kamu masih kosong.</p>
                    <a href="{{ route('home') }}" class="inline-block px-5 py-2.5 bg-slate-900 text-white font-bold text-xs rounded-xl shadow">
                        Lihat Katalog Produk
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-home-layout>