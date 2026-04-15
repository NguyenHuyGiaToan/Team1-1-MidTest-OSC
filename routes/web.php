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
Route::get('/caycanh_add', [App\Http\Controllers\AdminCayCanhController::class, 'caycanh_add'])->name("caycanh_add");
Route::post('/caycanh_add', [App\Http\Controllers\AdminCayCanhController::class, 'caycanh_add_func'])->name("caycanh_add_func");
Route::delete('/caycanh_delete/{id}', [App\Http\Controllers\AdminCayCanhController::class, 'caycanh_delete'])->name("caycanh_delete");
Route::get('/caycanh_manager', [App\Http\Controllers\AdminCayCanhController::class, 'caycanh_manager'])->name("caycanh_manager");

require __DIR__.'/auth.php';
