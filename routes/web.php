<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;





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