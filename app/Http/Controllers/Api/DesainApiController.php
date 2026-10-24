<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DesainResource;
use App\Models\Desain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DesainApiController extends Controller
{
    // READ (Daftar Produk + Search & Filter)
    public function index(Request $request)
    {
        $query = Desain::with('kategori');

        // Pencarian berdasarkan Judul
        if ($request->has('s')) {
            $query->where('judul', 'like', '%' . $request->s . '%');
        }

        // Filter berdasarkan Kategori
        if ($request->has('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $desains = $query->latest()->paginate(10);
        return DesainResource::collection($desains);
    }

    // CREATE (Tambah Produk + Upload File)
    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategoris,kategori_id',
            'harga'       => 'required|numeric',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('desains', 'public');
        }

        $desain = Desain::create([
            'judul'       => $request->judul,
            'kategori_id' => $request->kategori_id,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $imagePath,
            'slug'        => Str::slug($request->judul),
        ]);

        return new DesainResource($desain);
    }

    // READ SPECIFIC (Detail Produk)
    public function show(string $id)
    {
        $desain = Desain::with('kategori')->findOrFail($id);
        return new DesainResource($desain);
    }

    // UPDATE (Edit Produk + Ganti Gambar)
    public function update(Request $request, string $id)
    {
        $desain = Desain::findOrFail($id);

        $request->validate([
            'judul'       => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategoris,kategori_id',
            'harga'       => 'required|numeric',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $desain->gambar;
        if ($request->hasFile('gambar')) {
            if ($desain->gambar && Storage::disk('public')->exists($desain->gambar)) {
                Storage::disk('public')->delete($desain->gambar);
            }
            $imagePath = $request->file('gambar')->store('desains', 'public');
        }

        $desain->update([
            'judul'       => $request->judul,
            'kategori_id' => $request->kategori_id,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $imagePath,
            'slug'        => Str::slug($request->judul),
        ]);

        return new DesainResource($desain);
    }

    // DELETE (Hapus Produk & File Gambar)
    public function destroy(string $id)
    {
        $desain = Desain::find($id);

        if (!$desain) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        if ($desain->gambar && Storage::disk('public')->exists($desain->gambar)) {
            Storage::disk('public')->delete($desain->gambar);
        }

        $desain->delete();

        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}