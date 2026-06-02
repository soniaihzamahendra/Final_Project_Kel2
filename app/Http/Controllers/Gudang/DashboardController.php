<?php
namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use App\Models\StokBarang;      
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $cabangId = Auth::user()->cabang_id;

        return view('gudang.dashboard', [
            'total_barang'  => StokBarang::where('cabang_id', $cabangId)->count(),
            'stok_menipis'  => StokBarang::where('cabang_id', $cabangId)
                                    ->whereColumn('jumlah_stok', '<=', 'stok_minimum')
                                    ->count(),
            'stok_list'     => StokBarang::with('barang')
                                    ->where('cabang_id', $cabangId)
                                    ->whereColumn('jumlah_stok', '<=', 'stok_minimum')
                                    ->get(),
        ]);
    }
}
