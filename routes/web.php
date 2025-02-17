<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JadwalTravelController;
use App\Http\Controllers\Admin\LaporanTravelController;
use App\Http\Controllers\Admin\RiwayatPenumpangController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Penumpang\PemesananController;

Route::get('register', [AuthController::class, 'registerForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    
    Route::get('jadwal_travel', [JadwalTravelController::class, 'index'])->name('jadwal_travel.index');
    
    Route::get('jadwal_travel/create', [JadwalTravelController::class, 'create'])->name('jadwal_travel.create');
    
    Route::post('jadwal_travel', [JadwalTravelController::class, 'store'])->name('jadwal_travel.store');
    
    Route::get('jadwal_travel/{id}/edit', [JadwalTravelController::class, 'edit'])->name('jadwal_travel.edit');
    
    Route::put('jadwal_travel/{id}', [JadwalTravelController::class, 'update'])->name('jadwal_travel.update');
    
    Route::delete('jadwal_travel/{id}', [JadwalTravelController::class, 'destroy'])->name('jadwal_travel.destroy');

    Route::get('laporan', [LaporanTravelController::class, 'index'])->name('laporan.index');

    Route::get('riwayat', [RiwayatPenumpangController::class, 'index'])->name('riwayat.index');
    
    Route::put('riwayat/{id}', [RiwayatPenumpangController::class, 'update'])->name('riwayat.update');
    
    Route::get('riwayat/{id}/detail', [RiwayatPenumpangController::class, 'detail'])->name('riwayat.detail');

    Route::get('riwayat/{id}/invoice', [RiwayatPenumpangController::class, 'printInvoice'])->name('riwayat.invoice');

});

Route::prefix('penumpang')->name('penumpang.')->middleware('auth')->group(function () {
    Route::get('pesanan', [PemesananController::class, 'index'])->name('pesanan.index');

    Route::get('pesanan/create', [PemesananController::class, 'create'])->name('pesanan.create');
    
    Route::post('pesanan', [PemesananController::class, 'store'])->name('pesanan.store');
    
    Route::get('pesanan/{id}/detail', [PemesananController::class, 'detail'])->name('pesanan.detail');
    
    Route::get('pesanan/{id}/invoice', [PemesananController::class, 'printInvoice'])->name('pesanan.invoice');
    
    Route::post('pesanan/{id}/upload', [PemesananController::class, 'uploadBuktiPembayaran'])->name('pesanan.upload');
});