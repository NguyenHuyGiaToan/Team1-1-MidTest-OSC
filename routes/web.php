<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/san-pham/{id}', [HomeController::class, 'show'])->name('sanpham.show');
Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Duy Long


// Bích Ngân


// Gia Toàn

require __DIR__.'/auth.php';
use App\Http\Controllers\SanPhamController;

Route::post('/timkiem', [SanPhamController::class, 'search'])->name('search');