<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\DataUserController;
use App\Http\Controllers\Admin\DataAturanController;
use App\Http\Controllers\Admin\DataFaktorController;
use App\Http\Controllers\Admin\DataSolusiController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Admin\DataHimpunanController;
use App\Http\Controllers\Admin\DataPosyanduController;
use App\Http\Controllers\Admin\DataPuskesmasController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\PetugasPosyandu\DataBalitaController;
use App\Http\Controllers\PetugasPosyandu\RekapitulasiController;
use App\Http\Controllers\PetugasPosyandu\DataPengukuranController;
use App\Http\Controllers\PetugasPosyandu\HasilScreeningController;
use App\Http\Controllers\PetugasPosyandu\GrafikPertumbuhanController;
use App\Http\Controllers\PetugasPosyandu\DashboardPetugasPosyanduController;
use App\Http\Controllers\PetugasPuskesmas\DashboardPetugasPuskesmasController;
use App\Http\Controllers\PetugasPuskesmas\DaftarBalitaController;
use App\Http\Controllers\PetugasPuskesmas\ManajemenUserController;
use App\Http\Controllers\PetugasPuskesmas\LaporanScreeningController;
use App\Http\Controllers\PetugasPuskesmas\LaporanPengukuranController;



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/verifikasi-akun/{token}', [VerificationController::class, 'showVerificationPage'])->name('verify.page');
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::post('/verifikasi-akun/{token}', [VerificationController::class, 'verifyEmail'])->name('verify.email');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');

    // Data Puskesmas
    Route::get('/data-puskesmas', [DataPuskesmasController::class, 'index'])->name('data-puskesmas');
    Route::get('/data-puskesmas/create', [DataPuskesmasController::class, 'create'])->name('data-puskesmas.create');
    Route::post('/data-puskesmas/store', [DataPuskesmasController::class, 'store'])->name('data-puskesmas.store');
    Route::put('/data-puskesmas/{id}', [DataPuskesmasController::class, 'update'])->name('data-puskesmas.update');
    Route::delete('/data-puskesmas/{id}', [DataPuskesmasController::class, 'destroy'])->name('data-puskesmas.destroy');
    Route::get('/data-puskesmas/desa/{id_kecamatan}', [DataPuskesmasController::class, 'getDesa']);

    // Data Posyandu
    Route::get('/data-posyandu', [DataPosyanduController::class, 'index'])->name('data-posyandu');
    Route::get('/data-posyandu/create', [DataPosyanduController::class, 'create'])->name('data-posyandu.create');
    Route::post('/data-posyandu/store', [DataPosyanduController::class, 'store'])->name('data-posyandu.store');
    Route::get('/data-posyandu/desa/{id_kecamatan}', [DataPosyanduController::class, 'getDesa']);

    // Data User
    Route::get('/data-user', [DataUserController::class, 'index'])->name('data-user');
    Route::get('/data-user/create', [DataUserController::class, 'create'])->name('data-user.create');
    Route::post('/data-user/store', [DataUserController::class, 'store'])->name('data-user.store');

    // Data Faktor 
    Route::get('/data-faktor', [DataFaktorController::class, 'index'])->name('data-faktor');
    Route::post('/data-faktor/store', [DataFaktorController::class, 'store'])->name('data-faktor.store');
    Route::put('/data-faktor/update/{id}', [DataFaktorController::class, 'update'])->name('data-faktor.update');
    Route::delete('/data-faktor/delete/{id}', [DataFaktorController::class, 'destroy'])->name('data-faktor.destroy');

    // Data Himpunan
    Route::get('/data-himpunan', [DataHimpunanController::class, 'index'])->name('data-himpunan');
    Route::get('/data-himpunan/create', action: [DataHimpunanController::class, 'create'])->name('data-himpunan.create');
    Route::post('/data-himpunan/store', action: [DataHimpunanController::class, 'store'])->name('data-himpunan.store');
    Route::get('/data-himpunan/show/{id}', action: [DataHimpunanController::class, 'show'])->name('data-himpunan.show');
    Route::get('/data-himpunan/edit/{id}', [DataHimpunanController::class, 'edit'])->name('data-himpunan.edit');
    Route::put('/data-himpunan/update/{id}', [DataHimpunanController::class, 'update'])->name('data-himpunan.update');
    Route::delete('/data-himpunan/delete/{id}', [DataHimpunanController::class, 'destroy'])->name('data-himpunan.destroy');

    // Data Solusi
    Route::get('/data-solusi', [DataSolusiController::class, 'index'])->name('data-solusi');
    Route::get('/data-solusi/create', [DataSolusiController::class, 'create'])->name('data-solusi.create');

    // Data Aturan
    Route::get('/data-aturan', [DataAturanController::class, 'index'])->name('data-aturan');
    Route::get('/data-aturan/create', [DataAturanController::class, 'create'])->name('data-aturan.create');
    Route::post('/data-aturan/store', action: [DataaturanController::class, 'store'])->name('data-aturan.store');
    Route::get('/data-aturan/show/{id}', action: [DataAturanController::class, 'show'])->name('data-aturan.show');
    Route::get('/data-aturan/edit/{id}', [DataAturanController::class, 'edit'])->name('data-aturan.edit');
    Route::put('/data-aturan/update/{id}', [DataAturanController::class, 'update'])->name('data-aturan.update');
    Route::delete('/data-aturan/delete/{id}', [DataAturanController::class, 'destroy'])->name('data-aturan.destroy');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/show', [LaporanController::class, 'show'])->name('laporan.show');
});


Route::prefix('petugas-posyandu')->middleware(['auth', 'role:petugas_posyandu'])->name('petugas-posyandu.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardPetugasPosyanduController::class, 'index'])->name('dashboard');

    // Data Balita
    Route::get('/data-balita', [DataBalitaController::class, 'index'])->name('data-balita');
    Route::get('/data-balita/create', [DataBalitaController::class, 'create'])->name('data-balita.create');
    Route::post('/data-balita/store', [DataBalitaController::class, 'store'])->name('data-balita.store');
    Route::get('/data-balita/show/{id}', [DataBalitaController::class, 'show'])->name('data-balita.show');
    Route::get('/data-balita/edit/{id}', [DataBalitaController::class, 'edit'])->name('data-balita.edit');
    Route::put('/data-balita/update/{id}', [DataBalitaController::class, 'update'])->name('data-balita.update');
    Route::delete('/data-balita/delete/{id}', [DataBalitaController::class, 'destroy'])->name('data-balita.destroy');
    Route::get('/data-balita/export-pdf/{id}', [DataBalitaController::class, 'exportPDF'])->name('data-balita.export-pdf');

    // Data Pengukuran
    Route::get('/data-pengukuran', [DataPengukuranController::class, 'index'])->name('data-pengukuran');
    Route::get('/data-pengukuran/create/{id_balita}', [DataPengukuranController::class, 'create'])->name('data-pengukuran.create');
    Route::post('/data-pengukuran/store', [DataPengukuranController::class, 'store'])->name('data-pengukuran.store');
    Route::get('/data-pengukuran/show/{id}', [DataPengukuranController::class, 'show'])->name('data-pengukuran.show');
    Route::get('/data-pengukuran/edit/{id_balita}', [DataPengukuranController::class, 'edit'])->name('data-pengukuran.edit');
    Route::put('/data-pengukuran/update/{id_balita}', [DataPengukuranController::class, 'update'])->name('data-pengukuran.update');
    Route::delete('/data-pengukuran/delete/{id_balita}', [DataPengukuranController::class, 'destroy'])->name('data-pengukuran.destroy');
    Route::get('/data-pengukuran/download-file', [DataPengukuranController::class, 'download'])->name('data-pengukuran.download-file');
    Route::post('/data-pengukuran/import', [DataPengukuranController::class, 'import'])->name('data-pengukuran.import-excel');

    // Grafik Pertumbuhan
    Route::get('/grafik-pertumbuhan', [GrafikPertumbuhanController::class, 'index'])->name('grafik-pertumbuhan');
    Route::get('/grafik-pertumbuhan/show', [GrafikPertumbuhanController::class, 'show'])->name('grafik-pertumbuhan.show');
    Route::get('/grafik-pertumbuhan/tinggibadan/{id_balita}', [GrafikPertumbuhanController::class, 'showGrafikTinggiBadan'])->name('showGrafikTinggiBadan');
    Route::get('/grafik-pertumbuhan/beratbadan/{id_balita}', [GrafikPertumbuhanController::class, 'showGrafikBeratBadan'])->name('showGrafikBeratBadan');

    // Hasil Screening
    Route::get('/hasil-screening', [HasilScreeningController::class, 'index'])->name('hasil-screening');

    // Rekapitulasi
    Route::get('/rekapitulasi', [RekapitulasiController::class, 'index'])->name('rekapitulasi');
    Route::get('/rekapitulasi/export-pdf', [RekapitulasiController::class, 'exportPdf'])->name('rekapitulasi.export-pdf');
    Route::get('/rekapitulasi/export-excel', [RekapitulasiController::class, 'exportExcel'])->name('rekapitulasi.export-excel');
});



Route::prefix('petugas-puskesmas')->middleware(['auth', 'role:petugas_puskesmas'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardPetugasPuskesmasController::class, 'index'])->name('petugas-puskesmas.dashboard');

    // Daftar Balita
    Route::get('/daftar-balita', [DaftarBalitaController::class, 'index'])->name('petugas-puskesmas.daftar-balita');
    Route::get('/daftar-balita/show/{id}', [DaftarBalitaController::class, 'show'])->name('petugas-puskesmas.daftar-balita.show');
    Route::get('/daftar-balita/detail/{id}', [DaftarBalitaController::class, 'detail'])->name('petugas-puskesmas.daftar-balita.detail');

    // Laporan Screening
    Route::get('/laporan-screening', [LaporanScreeningController::class, 'index'])->name('petugas-puskesmas.laporan-screening');
    Route::get('/laporan-screening/show', [LaporanScreeningController::class, 'show'])->name('petugas-puskesmas.laporan-screening.show');
    Route::get('/laporan-screening/detail', [LaporanScreeningController::class, 'detail'])->name('petugas-puskesmas.laporan-screening.detail');

    // Laporan Pengukuran
    Route::get('/laporan-pengukuran', [LaporanPengukuranController::class, 'index'])->name('petugas-puskesmas.laporan-pengukuran');
    Route::get('/laporan-pengukuran/show', [LaporanPengukuranController::class, 'show'])->name('petugas-puskesmas.laporan-pengukuran.show');
    Route::get('/laporan-pengukuran/detail/{id}', [LaporanPengukuranController::class, 'detail'])->name('petugas-puskesmas.laporan-pengukuran.detail');
    Route::put('laporan-pengukuran/verifikasi', [LaporanPengukuranController::class, 'verifikasi'])->name('petugas-puskesmas.laporan-pengukuran.verifikasi');


    //Manajemen User
    Route::get('/manajemen-user', [ManajemenUserController::class, 'index'])->name('petugas-puskesmas.manajemen-user');
    Route::get('/manajemen-user/create', [ManajemenUserController::class, 'create'])->name('petugas-puskesmas.manajemen-user.create');
});


require __DIR__ . '/auth.php';


