<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\KonsultasiMessageController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminDashboardController;


/* ---------- HALAMAN USER ---------- */

Route::view('/',             'user.home');
Route::view('/profile',      'user.profile');
Route::view('/galery',       'user.galery');
Route::view('/konsultasi',   'user.konsultasi');

/* Form reservasi – perlu login */
Route::get('/form_reservasi', function () {
    return view('user.form_reservasi');
})->middleware(['auth', 'prevent-back-history']);

/* Simpan reservasi */
Route::post('/user/reservasi', [ReservasiController::class, 'store'])
    ->middleware(['auth', 'prevent-back-history']);
Route::get('/reservasi/create/{tanggal}', [ReservasiController::class, 'create'])->name('reservasi.create');

/* ---------- LOGIN USER ---------- */
// Route::get('/layanan', [LayananController::class, 'index'])->middleware(['auth', 'prevent-back-history']);
Route::get('/layanan', [LayananController::class, 'index'])->name('user.layanan')->middleware(['auth', 'prevent-back-history']);

Route::get('/konsultasi', [ChatController::class, 'index'])->name('user.konsultasi')->middleware(['auth', 'prevent-back-history']);
Route::get('/fetch-messages/{adminId}', [ChatController::class, 'fetchMessages'])->middleware(['auth', 'prevent-back-history']);
Route::post('/send-message', [ChatController::class, 'sendMessage'])->middleware(['auth', 'prevent-back-history']);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// Tampilkan halaman register
Route::get('/register', function () {
    return view('user.register');
});

// Tangani request POST register
Route::post('/register', [UserAuthController::class, 'register']);

// 🔓 Hanya untuk halaman login admin (tanpa auth)
Route::prefix('admin')->group(function () {
    Route::view('/login', 'admin.login')->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
});

// 🔒 Grup yang diproteksi middleware khusus admin
Route::prefix('admin')->middleware(['auth.admin', 'prevent-back-history'])->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::view('/akun',       'admin.akun')->name('admin.akun');
    Route::get('/layanan', [LayananController::class, 'index'])->name('admin.layanan');
    Route::view('/galery',     'admin.galery')->name('admin.galery');
    Route::view('/konsultasi',     'admin.konsultasi')->name('admin.konsultasi');
    Route::get('/konsultasi', [ChatController::class, 'index'])->name('admin.konsultasi');
    Route::get('/fetch-messages/{userId}', [ChatController::class, 'fetchMessages']);
    Route::post('/send-message', [ChatController::class, 'sendMessage']);
    Route::get('/form_reservasi', [ReservasiController::class, 'adminIndex'])->name('admin.reservasi');
    Route::patch('/admin/reservasi/{id}/accept', [ReservasiController::class, 'accept'])->name('admin.reservasi.accept');
    Route::delete('/admin/reservasi/{id}', [ReservasiController::class, 'destroy'])->name('admin.reservasi.destroy');
    Route::post('/jadwal-update', [LayananController::class, 'update'])->name('admin.jadwal.update');
});

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi.index');

Route::get('/login', function () {
    return view('user.login');
})->name('login');

Route::middleware(['auth.multi'])->group(function () {
    Route::get('/konsultasi', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/messages/{userId}', [ChatController::class, 'fetchMessages']);
    Route::post('/chat/send', [ChatController::class, 'sendMessage']);
});
