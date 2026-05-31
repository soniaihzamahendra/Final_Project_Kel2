<?php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\Transaksi;
use App\Models\StokBarang;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_cabang'     => Cabang::count(),
            'total_transaksi'  => Transaksi::count(),
            'transaksi_hari_ini' => Transaksi::whereDate('tanggal_transaksi', today())->sum('total_harga'),
            'stok_menipis'     => StokBarang::whereColumn('jumlah_stok', '<=', 'stok_minimum')->count(),
            'cabang'           => Cabang::withCount('transaksi')->get(),
        ];

        return view('owner.dashboard', $data);
    }
}