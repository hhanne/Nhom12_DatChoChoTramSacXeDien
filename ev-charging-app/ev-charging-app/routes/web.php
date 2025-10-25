<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TramSacController;
use App\Http\Controllers\DatChoController;


Route::middleware(['auth'])->group(function () {
    Route::get('/tramsac', [TramSacController::class, 'index'])->name('tramsac.index');
    Route::get('/tramsac/{id}', [TramSacController::class, 'show'])->name('tramsac.show');
});

Route::post('/datcho/check-availability', [DatChoController::class, 'checkAvailability'])->name('datcho.checkAvailability');


Route::middleware(['auth'])->group(function () {
    Route::get('/datcho/create', [DatChoController::class, 'create'])->name('datcho.create');
    Route::post('/datcho/store', [DatChoController::class, 'store'])->name('datcho.store');
    Route::post('/datcho/check-availability', [DatChoController::class, 'checkAvailability'])->name('datcho.checkAvailability');
});
Route::put('/datcho/{id}/cancel', [DatChoController::class, 'cancel'])
    ->name('datcho.cancel')
    ->middleware('auth');
 
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/history', [ProfileController::class, 'history'])->name('profile.history');
    // Trang đổi mật khẩu riêng
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});


Route::put('/user/password', [ProfileController::class, 'updatePassword'])
     ->name('password.update')
     ->middleware('auth');


use App\Http\Controllers\DanhGiaController;

Route::middleware(['auth'])->group(function () {
    Route::get('/danhgia/{tramsac_id}', [DanhGiaController::class, 'index'])->name('danhgia.index');
    Route::post('/danhgia/{tramsac_id}', [DanhGiaController::class, 'store'])->name('danhgia.store');
    Route::get('/danhgia-cua-toi', [DanhGiaController::class, 'myReviews'])->name('danhgia.my');
    //chỉnh sưae và cập nhật
    Route::get('/danhgia/{id}/edit', [DanhGiaController::class, 'edit'])->name('danhgia.edit');
    Route::put('/danhgia/{id}', [DanhGiaController::class, 'update'])->name('danhgia.update');
    // Xoá đánh giá
    Route::delete('/danhgia/{id}', [DanhGiaController::class, 'destroy'])->name('danhgia.destroy');
});
Route::put('/datcho/{id}/cancel', [DatChoController::class, 'cancel'])
    ->middleware('auth')
    ->name('datcho.cancel');

Route::delete('/datcho/{id}', [DatChoController::class, 'destroy'])
    ->middleware('auth')
    ->name('datcho.destroy');
    
require __DIR__.'/auth.php';
