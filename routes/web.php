<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);


Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

<<<<<<< HEAD
Route::get('/caycanh/theloai/{id}', function($id) {return redirect()->route('home', ['id_danh_muc' => $id]);});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/san-pham/{id}', [HomeController::class, 'show'])->name('sanpham.show');
Route::get('/gio-hang', [HomeController::class, 'cart'])->name('cart.index');
Route::post('/add-to-cart', [HomeController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [HomeController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/checkout', [HomeController::class, 'checkout'])->name('cart.checkout');
=======
// Duy Long
>>>>>>> 9718cf686b3c4765ed522b050c32fea25c882cce

// Xem chi tiết sản phẩm
Route::get('/san-pham/{id}', [HomeController::class, 'show'])->name('sanpham.show');

// Thêm vào giỏ hàng
Route::post('/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');

// Bích Ngân


// Gia Toàn

require __DIR__.'/auth.php';


// Route hiển thị trang giỏ hàng
Route::get('/gio-hang', [HomeController::class, 'cart'])->name('cart.index');

// Route xử lý Xóa sản phẩm khỏi giỏ
Route::post('/cart/remove', [HomeController::class, 'removeFromCart'])->name('cart.remove');

// Route xử lý Đặt hàng (lưu vào Database)
Route::post('/cart/checkout', [HomeController::class, 'checkout'])->name('cart.checkout');

Route::get('/', [HomeController::class, 'index'])->name('home');