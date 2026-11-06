<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DesainApiController;
use App\Http\Controllers\Api\NilaiApiController;
use Illuminate\Support\Facades\Route;
use App\Models\Kategori;
use App\Models\Desain;
use Illuminate\Http\Request;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/categories', function () {
    return response()->json(Kategori::all());
});

Route::get('/desains', function (Request $request) {
    $query = Desain::with('kategori');

    // 1. Filter Kategori
    $categoryId = $request->get('category_id');
    if (!empty($categoryId)) {
        $query->where('kategori_id', $categoryId);
    }

    // 2. Filter Keyword
    $keyword = $request->get('keyword');
    if (!empty($keyword)) {
        $query->where(function ($q) use ($keyword) {
            $q->where('judul', 'like', '%' . trim($keyword) . '%')
              ->orWhere('nama_desain', 'like', '%' . trim($keyword) . '%');
        });
    }

    // 3. Sorting Aman (Hanya urutkan jika parameter valid)
    $sortBy = $request->get('sort_by');
    $sortOrder = strtolower($request->get('sort_order', 'asc')) === 'desc' ? 'desc' : 'asc';

    if (in_array($sortBy, ['harga', 'judul', 'created_at'])) {
        $query->orderBy($sortBy, $sortOrder);
    } else {
        $query->orderBy('created_at', 'desc'); // Default order
    }

    // 4. Paginasi
    $limit = (int) $request->get('limit', 5);
    return response()->json($query->paginate($limit));
});

Route::get('/desains/{id}', [DesainApiController::class, 'show']);

Route::apiResource('nilais', NilaiApiController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/desains', [DesainApiController::class, 'store']);
    Route::post('/desains/{id}', [DesainApiController::class, 'update']);
    Route::delete('/desains/{id}', [DesainApiController::class, 'destroy']);

    Route::post('/categories', function (Request $request) {
        $request->validate(['nama_kategori' => 'required|string|unique:kategoris,nama_kategori']);
        $kategori = Kategori::create(['nama_kategori' => $request->nama_kategori]);
        return response()->json($kategori, 201);
    });

    Route::delete('/categories/{id}', function ($id) {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return response()->json(['message' => 'Kategori berhasil dihapus']);
    });
});