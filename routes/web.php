<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Direktur\KaryawanController;
use App\Http\Controllers\Direktur\KelolaReimbursementController;
use App\Http\Controllers\Finance\DaftarPengajuanReimbursementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff\PengajuanReinbursementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::group(['middleware' => 'jabatan:Direktur'], function () {
        Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
        Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
        Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
        Route::get('/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
        Route::put('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
        Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');

        Route::get('/kelola-reimbursement', [KelolaReimbursementController::class, 'index'])->name('kelola-reimbursement');
        Route::get('/kelola-reimbursement/{id}', [KelolaReimbursementController::class, 'show'])->name('kelola-reimbursement.show');
        Route::put('/kelola-reimbursement/{id}', [KelolaReimbursementController::class, 'update'])->name('kelola-reimbursement.update');
    });

    Route::group(['middleware' => 'jabatan:Finance'], function () {
        Route::get('/daftar-pengajuan-reimbursement', [DaftarPengajuanReimbursementController::class, 'index'])->name('daftar-pengajuan-reimbursement');
        Route::get('/daftar-pengajuan-reimbursement/{id}', [DaftarPengajuanReimbursementController::class, 'show'])->name('daftar-pengajuan-reimbursement.show');
        Route::put('/daftar-pengajuan-reimbursement/{id}', [DaftarPengajuanReimbursementController::class, 'update'])->name('daftar-pengajuan-reimbursement.update');
    });

    Route::group(['middleware' => 'jabatan:Staff'], function () {
        Route::get('/pengajuan-reimbursement', [PengajuanReinbursementController::class, 'index'])->name('pengajuan-reimbursement');
        Route::get('/pengajuan-reimbursement/create', [PengajuanReinbursementController::class, 'create'])->name('pengajuan-reimbursement.create');
        Route::post('/pengajuan-reimbursement', [PengajuanReinbursementController::class, 'store'])->name('pengajuan-reimbursement.store');
        Route::get('/pengajuan-reimbursement/{id}', [PengajuanReinbursementController::class, 'show'])->name('pengajuan-reimbursement.show');
        Route::delete('/pengajuan-reimbursement/{id}', [PengajuanReinbursementController::class, 'destroy'])->name('pengajuan-reimbursement.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
