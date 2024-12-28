<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Layout;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\sendEmailController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\ProfilController;


// Rute untuk pengguna tamu
Route::middleware(['guest'])->group(function () {
    Route::get('/loginpanel', [LoginController::class, 'index'])->name('loginpanel');
    Route::post('/loginpanel', [LoginController::class, 'ceklogin'])->name('login.cek');
});

// Rute default
Route::get('/', [HomeController::class, 'index']);

Route::get('/panduanpengguna', [PanduanController::class, 'index']);

// Rute redirect ke home
Route::get('/home', function () {
    return redirect('/layout/home');
});

// Rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/layout/home', [Layout::class, 'home']);

    // Rute Data Warga
    Route::resource('/Wargas', WargaController::class);
    Route::get('/Wargas/export/excel', [WargaController::class, 'exportExcel'])->name('Wargas.export.excel');
    Route::get('/Wargas/export/pdf', [WargaController::class, 'exportPdf'])->name('Wargas.export.pdf');

    // Rute Data Pembayaran
    Route::resource('Pembayarans', PembayaranController::class);
    Route::get('/Pembayarans/export/excel', [PembayaranController::class, 'exportExcel'])->name('Pembayarans.export.excel');
    Route::get('/Pembayarans/export/pdf', [PembayaranController::class, 'exportPdf'])->name('Pembayarans.export.pdf');

    // Rute profil
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/image', [ProfilController::class, 'updateImage'])->name('profil.updateImage');

    // Rute notifikasi email
    Route::get('/email', [sendEmailController::class, 'index'])->name('email');
    Route::get('/send_email', [sendEmailController::class, 'send_email'])->name('send_email');

    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});
