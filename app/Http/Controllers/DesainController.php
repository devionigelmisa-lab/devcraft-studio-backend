<?php

namespace App\Http\Controllers;

use App\Models\Desain;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DesainController extends Controller
{
    public function index()
    {
        $desains = Desain::with('kategori')->latest()->paginate(10);
        return view('admin.index', compact('desains'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategoris,kategori_id',
            'harga'       => 'required|numeric',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'required|url',
        ]);

        Desain::create([
            'judul'       => $request->judul,
            'kategori_id' => $request->kategori_id,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $request->gambar,
            'slug'        => Str::slug($request->judul),
        ]);

        return redirect()->route('desain.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $desain = Desain::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.edit', compact('desain', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $desain = Desain::findOrFail($id);

        $request->validate([
            'judul'       => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategoris,kategori_id',
            'harga'       => 'required|numeric',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'required|url',
        ]);

        $desain->update([
            'judul'       => $request->judul,
            'kategori_id' => $request->kategori_id,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $request->gambar,
            'slug'        => Str::slug($request->judul),
        ]);

        return redirect()->route('desain.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $desain = Desain::findOrFail($id);
        $desain->delete();

        return redirect()->route('desain.index')->with('success', 'Produk berhasil dihapus!');
    }
}