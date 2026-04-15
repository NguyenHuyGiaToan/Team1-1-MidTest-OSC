<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);


Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Duy Long


// Bích Ngân


// Gia Toàn

require __DIR__.'/auth.php';
