<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\UserController as UserAuthController;
use App\Http\Controllers\Auth\AdminController as AdminAuthController;
use App\Http\Controllers\Admin\PenyewaController;

Route::get('/', fn() => redirect('login'));

// User Auth
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [UserAuthController::class, 'register']);

// Admin Auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// Admin routes
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/pembayaran', [AdminController::class, 'pembayaran'])->name('admin.pembayaran');
    Route::post('/pembayaran/{id}/konfirmasi', [AdminController::class, 'konfirmasiPembayaran'])->name('admin.konfirmasi');
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::post('/laporan/{id}/status', [AdminController::class, 'updateStatusLaporan'])->name('admin.laporan.status');
    Route::post('/pembayaran/{id}/tolak', [AdminController::class, 'tolakPembayaran'])->name('admin.tolak');
    Route::get('/notif-count', [AdminController::class, 'notifCount'])->name('admin.notif.count');
    Route::get('/data-penyewa', [PenyewaController::class, 'index'])->name('admin.data-penyewa');
    Route::get('/data-penyewa/data', [PenyewaController::class, 'getData'])->name('api.penyewa.get');
    Route::post('/data-penyewa', [PenyewaController::class, 'store'])->name('api.penyewa.store');
    Route::delete('/data-penyewa/{id}', [PenyewaController::class, 'destroy'])->name('api.penyewa.destroy');
});

//User routes
Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/pembayaran', [UserController::class, 'pembayaran'])->name('user.pembayaran');
    Route::post('/pembayaran/{id}/upload', [UserController::class, 'uploadBukti'])->name('pembayaran.upload');
    Route::get('/laporan', [UserController::class, 'laporan'])->name('user.laporan');
    Route::post('/laporan', [UserController::class, 'storeLaporan'])->name('laporan.store');
    Route::get('/riwayat', [UserController::class, 'riwayat'])->name('user.riwayat');
    Route::get('/notifikasi/{id}/baca', [UserController::class, 'bacaNotif'])->name('notifikasi.baca');
    Route::get('/notifikasi/baca-semua', [UserController::class, 'bacaSEmuaNotif'])->name('notifikasi.baca-semua');
});