<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {
    if (auth()->check()) {
        return match(auth()->user()->role) {
            'owner'          => redirect()->route('owner.dashboard'),
            'manajer_toko'   => redirect()->route('manajer.dashboard'),
            'supervisor'     => redirect()->route('supervisor.dashboard'),
            'kasir'          => redirect()->route('kasir.dashboard'),
            'pegawai_gudang' => redirect()->route('gudang.dashboard'),
            default          => redirect('/login'),
        };
    }
    return redirect('/login');
});

// OWNER
Route::prefix('owner')->middleware(['auth', 'role:owner'])->name('owner.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Owner\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/cabang', \App\Http\Controllers\Owner\CabangController::class);
    Route::get('/laporan', [\App\Http\Controllers\Owner\LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/cetak', [\App\Http\Controllers\Owner\LaporanController::class, 'cetak'])->name('laporan.cetak');
});

// MANAJER 


// SUPERVISOR


// KASIR 


// GUDANG
