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
Route::prefix('supervisor')->middleware(['auth', 'role:supervisor'])->name('supervisor.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Supervisor\DashboardController::class, 'index'])->name('dashboard');
    // Monitor transaksi 
    Route::get('/transaksi', [\App\Http\Controllers\Supervisor\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{id}', [\App\Http\Controllers\Supervisor\TransaksiController::class, 'show'])->name('transaksi.show');
    // Monitor stok 
    Route::get('/stok', [\App\Http\Controllers\Supervisor\StokController::class, 'index'])->name('stok.index');
    Route::get('/stok/riwayat', [\App\Http\Controllers\Supervisor\StokController::class, 'riwayat'])->name('stok.riwayat');
});



// KASIR 


// GUDANG
Route::prefix('gudang')->middleware(['auth', 'role:pegawai_gudang'])->name('gudang.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Gudang\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stok', [\App\Http\Controllers\Gudang\StokController::class, 'index'])->name('stok.index');
    Route::put('/stok/{id}', [\App\Http\Controllers\Gudang\StokController::class, 'update'])->name('stok.update');
    Route::get('/stok/riwayat', [\App\Http\Controllers\Gudang\StokController::class, 'riwayat'])->name('stok.riwayat');
});

