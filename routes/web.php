<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasKesehatan\DashboardController;
use App\Http\Controllers\PetugasKesehatan\DataBalitaController;
use App\Http\Controllers\PetugasKesehatan\DataPengukuranController;
use App\Http\Controllers\PetugasKesehatan\GrafikPertumbuhanController;
use App\Http\Controllers\PetugasKesehatan\HasilScreeningController;






Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('petugas.dashboard');

// Data Balita
Route::get('/data-balita', [DataBalitaController::class, 'index'])->name('petugas.databalita');
Route::get('/data-balita/create', [DataBalitaController::class, 'create'])->name('petugas.databalita.create');
Route::get('/data-balita/detail', [DataBalitaController::class, 'detail'])->name('petugas.databalita.detail');

// Data Pengukuran
Route::get('/data-pengukuran', [DataPengukuranController::class, 'index'])->name('petugas.datapengukuran');

// Grafik Pertumbuhan
Route::get('/grafik-pertumbuhan', [GrafikPertumbuhanController::class, 'index'])->name('petugas.grafikpertumbuhan');
Route::get('/grafik-pertumbuhan/detail', [GrafikPertumbuhanController::class, 'detail'])->name('petugas.grafikpertumbuhan.detail');

Route::get('/hasil-screening', [HasilScreeningController::class, 'index'])->name('petugas.hasilscreening');






require __DIR__.'/auth.php';
