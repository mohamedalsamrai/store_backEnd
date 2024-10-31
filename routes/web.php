<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;

// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
// Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
// Route::get('/products', [ProductController::class, 'index'])->name('products.index');


// Route::get('/add-product', function () {
//     return view('add_product');
// })->name('products.create');

// Route::post('/add-product', [ProductController::class, 'store'])->name('products.store');

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);
Route::get('verify-email/{id}', [AuthController::class, 'verifyEmail'])->name('verification.verify');

// مسارات إعادة تعيين كلمة المرور

Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

// إضافة مسار لإعادة تعيين كلمة المرور
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::get('/password-reset-success', function () {
    return view('auth.password_reset_success');
})->name('password.reset.success');