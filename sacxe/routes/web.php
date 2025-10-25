<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrangchuController;
use App\Http\Controllers\KhachhangController;
use App\Http\Controllers\TramsacController;
use App\Http\Controllers\CongsacController;
use App\Http\Controllers\DatchoController;
use App\Http\Controllers\DangnhapController;

// ==========================
// 🔹 ROUTE MẶC ĐỊNH
// ==========================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ==========================
// 🔹 XÁC THỰC
// ==========================
Route::get('/dangnhap', [DangnhapController::class, 'showLoginForm'])->name('login');
Route::post('/dangnhap', [DangnhapController::class, 'login'])->name('login');
Route::post('/logout', [DangnhapController::class, 'logout'])->name('logout');
// 🔹 QUẢN LÝ ADMIN
// ==========================
Route::prefix('admin/products')->group(function () {
    // Trang chủ admin
    Route::get('/', [TrangchuController::class, 'index'])->name('admin.products.index');

    // Các module quản lý
    Route::get('/khachhang', [KhachhangController::class, 'index'])->name('admin.khachhang.index');
    Route::get('/tramsac', [TramsacController::class, 'index'])->name('admin.tramsac.index');
    Route::get('/congsac', [CongsacController::class, 'index'])->name('admin.congsac.index');
    Route::get('/datcho', [DatchoController::class, 'index'])->name('admin.products.datcho.index');
});

// ==========================
// 🔹 NHÓM ROUTE CHỈNH SỬA (CRUD)
// ==========================
Route::prefix('chinhsua')->group(function () {

    // ----------- ⚙️ KHÁCH HÀNG -----------
    Route::get('/khachhang', [KhachhangController::class, 'index'])->name('chinhsua.khachhang.index');
    Route::get('/them-khach', [KhachhangController::class, 'create'])->name('chinhsua.themkhach');
    Route::post('/them-khach', [KhachhangController::class, 'store'])->name('chinhsua.khachhang.store');
    Route::get('/chitiet-khach/{id}', [KhachhangController::class, 'show'])->name('chinhsua.khachhang.show');
    Route::get('/sua-khach/{id}', [KhachhangController::class, 'edit'])->name('chinhsua.khachhang.edit');
    Route::put('/sua-khach/{id}', [KhachhangController::class, 'update'])->name('chinhsua.khachhang.update');
    Route::get('/xoa-khach/{id}/confirm', [KhachhangController::class, 'delete'])->name('chinhsua.khachhang.delete');
    Route::delete('/xoa-khach/{id}', [KhachhangController::class, 'destroy'])->name('chinhsua.khachhang.destroy');

    // ----------- ⚙️ TRẠM SẠC -----------
    Route::get('/tramsac', [TramsacController::class, 'index'])->name('chinhsua.tramsac.index');
    Route::get('/them-tram', [TramsacController::class, 'create'])->name('chinhsua.tramsac.create');
    Route::post('/them-tram', [TramsacController::class, 'store'])->name('chinhsua.tramsac.store');
    Route::get('/chitiet-tram/{id}', [TramsacController::class, 'show'])->name('chinhsua.tramsac.show');
    Route::get('/sua-tram/{id}', [TramsacController::class, 'edit'])->name('chinhsua.tramsac.edit');
    Route::put('/sua-tram/{id}', [TramsacController::class, 'update'])->name('chinhsua.tramsac.update');
    Route::get('/xoa-tram/{tramsac_id}/confirm', [TramsacController::class, 'delete'])->name('chinhsua.tramsac.delete');
    Route::delete('/xoa-tram/{tramsac_id}', [TramsacController::class, 'destroy'])->name('chinhsua.tramsac.destroy');

    // ----------- ⚙️ CỔNG SẠC -----------
    Route::get('/congsac', [CongsacController::class, 'index'])->name('chinhsua.congsac.index');
    Route::get('/them-cong', [CongsacController::class, 'create'])->name('chinhsua.congsac.create');
    Route::post('/them-cong', [CongsacController::class, 'store'])->name('chinhsua.congsac.store');
    Route::get('/chitiet-cong/{id}', [CongsacController::class, 'show'])->name('chinhsua.congsac.show');
    Route::get('/sua-cong/{id}', [CongsacController::class, 'edit'])->name('chinhsua.congsac.edit');
    Route::put('/sua-cong/{id}', [CongsacController::class, 'update'])->name('chinhsua.congsac.update');
    Route::get('/xoa-cong/{congsac_id}', [CongsacController::class, 'delete'])->name('chinhsua.congsac.delete');
    Route::delete('/xoa-cong/{id}', [CongsacController::class, 'destroy'])->name('chinhsua.congsac.destroy');
    
});

// ==========================
// 🔹 USER DASHBOARD
// ==========================
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware('auth')->name('user.dashboard');