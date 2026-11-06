<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DesainController;
use Illuminate\Support\Facades\Route;

// Frontpage & Checkout
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.detail');
Route::post('/cart/add/{id}', [HomeController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');

// Route Baru untuk Proses Pembayaran & Kosongkan Keranjang
Route::post('/checkout/process', [HomeController::class, 'processCheckout'])->name('checkout.process');

// Backpage Admin Panel
Route::get('/admin/{any?}', function () {
    return view('welcome'); 
})->where('any', '.*');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DesainController::class, 'index'])->name('dashboard');
    Route::resource('desain', DesainController::class);
});

require __DIR__.'/auth.php';