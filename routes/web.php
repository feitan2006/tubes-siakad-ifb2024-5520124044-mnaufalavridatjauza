<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;

// Dashboard redirect
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        $totalDosen = \App\Models\Dosen::count();
        $totalMahasiswa = \App\Models\Mahasiswa::count();
        $totalMataKuliah = \App\Models\MataKuliah::count();
        $totalJadwal = \App\Models\Jadwal::count();
        $totalKrs = \App\Models\Krs::count();
        $krsPerMahasiswa = \App\Models\Krs::selectRaw('npm, count(*) as total')
            ->groupBy('npm')->orderByDesc('total')->with('mahasiswa')->take(5)->get();
        $mataKuliahTerpopuler = \App\Models\Krs::selectRaw('kode_matakuliah, count(*) as total')
            ->groupBy('kode_matakuliah')->orderByDesc('total')->with('mataKuliah')->take(5)->get();
        return view('admin.dashboard', compact(
            'totalDosen', 'totalMahasiswa', 'totalMataKuliah',
            'totalJadwal', 'totalKrs', 'krsPerMahasiswa', 'mataKuliahTerpopuler'
        ));
    }
    return redirect()->route('mahasiswa.dashboard');
})->middleware('auth')->name('dashboard');

// Route Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $totalDosen = \App\Models\Dosen::count();
        $totalMahasiswa = \App\Models\Mahasiswa::count();
        $totalMataKuliah = \App\Models\MataKuliah::count();
        $totalJadwal = \App\Models\Jadwal::count();
        $totalKrs = \App\Models\Krs::count();
        $krsPerMahasiswa = \App\Models\Krs::selectRaw('npm, count(*) as total')
            ->groupBy('npm')->orderByDesc('total')->with('mahasiswa')->take(5)->get();
        $mataKuliahTerpopuler = \App\Models\Krs::selectRaw('kode_matakuliah, count(*) as total')
            ->groupBy('kode_matakuliah')->orderByDesc('total')->with('mataKuliah')->take(5)->get();
        return view('admin.dashboard', compact(
            'totalDosen', 'totalMahasiswa', 'totalMataKuliah',
            'totalJadwal', 'totalKrs', 'krsPerMahasiswa', 'mataKuliahTerpopuler'
        ));
    })->name('dashboard');

    Route::resource('dosen', DosenController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('mata-kuliah', MataKuliahController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::get('krs/export-excel', [KrsController::class, 'exportExcel'])->name('krs.export.excel');
    Route::get('krs/export-pdf', [KrsController::class, 'exportPdf'])->name('krs.export.pdf');
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

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
});

// Logout
Route::get('/keluar', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->middleware('auth')->name('keluar');

require __DIR__.'/auth.php';