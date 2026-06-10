<?php
namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;       
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $cabangId = Auth::user()->cabang_id;

        return view('kasir.dashboard', [
            'total_transaksi'    => Transaksi::where('cabang_id', $cabangId)->count(),
            'transaksi_hari_ini' => Transaksi::where('cabang_id', $cabangId)
                                        ->whereDate('tanggal_transaksi', today())
                                        ->count(),
            'transaksi_terbaru'  => Transaksi::where('cabang_id', $cabangId)
                                        ->latest()
                                        ->take(5)
                                        ->get(),
        ]);
    }
}
