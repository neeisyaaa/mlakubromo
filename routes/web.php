<?php
// =====================================
// FILE: routes/web.php
// =====================================

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/paket-trip', function () {
    return view('paket-trip');
})->name('paket-trip');

Route::get('/opentrip/{tripName?}', function () {
    return view('opentrip');
})->name('opentrip');

Route::get('/dailytrip', function () {
    return view('dailytrip');
})->name('dailytrip');

Route::get('/travelbromo', function () {
    return view('travelbromo');
})->name('travelbromo');

Route::get('/paketwna', function () {
    return view('paketwna');
})->name('paketwna');
    
Route::get('/cara-pemesanan', function () {
    return view('carapemesanan');
})->name('cara-pemesanan');

Route::get('/galeri', function () {
    return view('galeri');
})->name('galeri');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/profil', function () {
    return view('profil');
})->name('profil');

Route::get('/riwayatpesan', function () {
    return view('riwayatpesan');
})->name('riwayatpesan');

Route::get('/riwayattesti', function () {
    return view('riwayattesti');
})->name('riwayattesti');

?>