<?php


use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\DataAturanController;
use App\Http\Controllers\Admin\DataFaktorController;
use App\Http\Controllers\Admin\DataHimpunanController;
use App\Http\Controllers\Admin\DataPosyanduController;
use App\Http\Controllers\Admin\DataPuskesmasController;
use App\Http\Controllers\Admin\DataSolusiController;
use App\Http\Controllers\Admin\DataUserController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\PetugasKesehatan\DashboardController;
use App\Http\Controllers\PetugasKesehatan\DataBalitaController;
use App\Http\Controllers\PetugasKesehatan\DataPengukuranController;
use App\Http\Controllers\PetugasKesehatan\GrafikPertumbuhanController;
use App\Http\Controllers\PetugasKesehatan\HasilScreeningController;
use App\Http\Controllers\PetugasKesehatan\RekapitulasiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('petugas')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('petugas.dashboard');

    // Data Balita
    Route::get('/data-balita', [DataBalitaController::class, 'index'])->name('petugas.data-balita');
    Route::get('/data-balita/create', [DataBalitaController::class, 'create'])->name('petugas.data-balita.create');
    Route::get('/data-balita/show', [DataBalitaController::class, 'show'])->name('petugas.data-balita.show');

    // Data Pengukuran
    Route::get('/data-pengukuran', [DataPengukuranController::class, 'index'])->name('petugas.data-pengukuran');

    // Grafik Pertumbuhan
    Route::get('/grafik-pertumbuhan', [GrafikPertumbuhanController::class, 'index'])->name('petugas.grafik-pertumbuhan');
    Route::get('/grafik-pertumbuhan/show', [GrafikPertumbuhanController::class, 'show'])->name('petugas.grafik-pertumbuhan.show');

    // Hasil Screening
    Route::get('/hasil-screening', [HasilScreeningController::class, 'index'])->name('petugas.hasil-screening');

    // Rekapitulasi
    Route::get('/rekapitulasi', [RekapitulasiController::class, 'index'])->name('petugas.rekapitulasi');

});

Route::prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    // Data Puskesmas
    Route::get('/data-puskesmas', [DataPuskesmasController::class, 'index'])->name('admin.data-puskesmas');

    // Data Posyandu
    Route::get('/data-posyandu', [DataPosyanduController::class, 'index'])->name('admin.data-posyandu');
    Route::get('/data-posyandu/create', [DataPosyanduController::class, 'create'])->name('admin.data-posyandu.create');

    // Data User
    Route::get('/data-user', [DataUserController::class, 'index'])->name('admin.data-user');

    // Data Faktor 
    Route::get('/data-faktor', [DataFaktorController::class, 'index'])->name('admin.data-faktor');

    // Data Himpunan
    Route::get('/data-himpunan', [DataHimpunanController::class, 'index'])->name('admin.data-himpunan');
    Route::get('/data-himpunan/create', action: [DataHimpunanController::class, 'create'])->name('admin.data-himpunan.create');
    Route::get('/data-himpunan/show', action: [DataHimpunanController::class, 'show'])->name('admin.data-himpunan.show');

    // Data Solusi
    Route::get('/data-solusi', [DataSolusiController::class, 'index'])->name('admin.data-solusi');
    Route::get('/data-solusi/create', [DataSolusiController::class, 'create'])->name('admin.data-solusi.create');

    // Data Aturan
    Route::get('/data-aturan', [DataAturanController::class, 'index'])->name('admin.data-aturan');
    Route::get('/data-aturan/create', [DataAturanController::class, 'create'])->name('admin.data-aturan.create');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
    Route::get('/laporan/show', [LaporanController::class, 'show'])->name('admin.laporan.show');
});






require __DIR__ . '/auth.php';
