<x-home-layout>
    <div class="max-w-3xl mx-auto py-12 px-6">
        <h1 class="text-3xl font-extrabold text-white mb-6 text-center">Checkout & Pembayaran</h1>
        
        <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
            <!-- Form Checkout dikoneksikan ke route('checkout.process') -->
            <form action="{{ route('checkout.process') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" required placeholder="Masukkan nama kamu" class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-slate-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Email (Untuk Pengiriman File Digital)</label>
                    <input type="email" name="email" required placeholder="nama@email.com" class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-slate-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Metode Pembayaran</label>
                    <select name="metode" required class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm bg-white">
                        <option value="QRIS / GoPay / OVO">QRIS / GoPay / OVO</option>
                        <option value="Transfer Bank BCA">Transfer Bank BCA</option>
                        <option value="Transfer Bank Mandiri">Transfer Bank Mandiri</option>
                    </select>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-3.5 bg-[#25A174] hover:bg-emerald-700 text-white font-bold rounded-xl text-sm transition shadow">
                        Konfirmasi & Bayar Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-home-layout>