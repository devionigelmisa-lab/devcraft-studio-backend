<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desain;
use App\Models\Kategori;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('s');
        $kategoriId = $request->input('id_kategori');

        $query = Desain::with('kategori');

        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%');
        }

        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        $products = $query->latest()->get();
        $kategoris = Kategori::all();

        return view('frontpage.landingpage', compact('products', 'kategoris'));
    }

    // Detail Produk
    public function show($id)
    {
        $product = Desain::with('kategori')->findOrFail($id);
        return view('frontpage.detail', compact('product'));
    }

    // Tambah Produk ke Session Keranjang
    public function addToCart($id)
    {
        $product = Desain::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'title' => $product->judul,
                'price' => $product->harga,
                'image' => $product->gambar,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Halaman Keranjang
    public function cart()
    {
        return view('frontpage.cart');
    }

    // Halaman Checkout
    public function checkout()
    {
        return view('frontpage.checkout');
    }
    public function processCheckout(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'metode' => 'required|string',
        ]);

     
        session()->forget('cart');

        // Redirect kembali ke Katalog/Home dengan pesan sukses
        return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat! File akan dikirim ke email kamu.');
    }
}