<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;

// Redirect dashboard berdasarkan role
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('mahasiswa.dashboard');
})->middleware('auth')->name('dashboard');

// Route Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('dosen', DosenController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('mata-kuliah', MataKuliahController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::get('krs', [KrsController::class, 'indexAdmin'])->name('krs.index');
});

// Route Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('dashboard');

    Route::get('jadwal', [JadwalController::class, 'indexMahasiswa'])->name('jadwal.index');
    Route::get('krs', [KrsController::class, 'indexMahasiswa'])->name('krs.index');
    Route::post('krs', [KrsController::class, 'store'])->name('krs.store');
    Route::delete('krs/{id}', [KrsController::class, 'destroy'])->name('krs.destroy');
});

require __DIR__.'/auth.php';