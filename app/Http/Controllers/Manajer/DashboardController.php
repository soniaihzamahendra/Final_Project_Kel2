<?php
namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;        
use App\Models\StokBarang;     
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $cabangId = Auth::user()->cabang_id;
        $data = [
            'total_transaksi'     => Transaksi::where('cabang_id', $cabangId)->count(),
            'pendapatan_hari_ini' => Transaksi::where('cabang_id', $cabangId)
                                        ->whereDate('tanggal_transaksi', today())
                                        ->sum('total_harga'),
            'stok_menipis'        => StokBarang::where('cabang_id', $cabangId)
                                        ->whereColumn('jumlah_stok', '<=', 'stok_minimum')
                                        ->count(),
            'transaksi_terbaru'   => Transaksi::with('user')
                                        ->where('cabang_id', $cabangId)
                                        ->latest()
                                        ->take(10)
                                        ->get(),
        ];
        return view('manajer.dashboard', $data);
    }
}
