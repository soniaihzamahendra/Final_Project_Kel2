<?php
namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\StokBarang;
use App\Models\RiwayatStok;
use Illuminate\Support\Facades\Auth;

class StokController extends Controller
{
    public function index()
    {
        $stok = StokBarang::with('barang.kategori')
            ->where('cabang_id', Auth::user()->cabang_id)
            ->get();

        return view('manajer.stok.index', compact('stok'));
    }

    public function riwayat()
    {
        $riwayat = RiwayatStok::with(['barang', 'user'])
            ->where('cabang_id', Auth::user()->cabang_id)
            ->latest()
            ->paginate(15);

        return view('manajer.stok.riwayat', compact('riwayat'));
    }
}
