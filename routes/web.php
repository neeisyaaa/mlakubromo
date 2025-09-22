<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

// ================= AUTH =================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ================= GALERY UMUM =================
Route::get('/galery', [AdminController::class, 'galery'])->name('galery');

// ================= ADMIN =================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Paket
    Route::get('/pesan-paket', [AdminController::class, 'pesanPaket'])->name('pesan-paket');
    Route::get('/pilihan-paket', [AdminController::class, 'pilihanPaket'])->name('pilihan-paket');

    // Galery dalam admin
    Route::get('/galery', [AdminController::class, 'galery'])->name('galery.admin');

    // Cara Pemesanan
    Route::get('/cara-pemesanan', [AdminController::class, 'caraPemesanan'])->name('cara-pemesanan');

    // Kontak
    Route::get('/kontak', [AdminController::class, 'kontak'])->name('kontak');

    // Paket Trip
    Route::get('/paket-trip', [AdminController::class, 'paketTrip'])->name('paket-trip');

    // CRUD Users
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.destroy');

   // Profile
Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');

    // Notifications
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');

    // Contacts
    Route::resource('contacts', ContactController::class);
});
