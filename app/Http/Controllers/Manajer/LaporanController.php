<?php
namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;          
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;   

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $cabangId = Auth::user()->cabang_id;
        $query    = Transaksi::with(['user'])->where('cabang_id', $cabangId);

        if ($request->dari) {
            $query->whereDate('tanggal_transaksi', '>=', $request->dari);
        }
        if ($request->sampai) {
            $query->whereDate('tanggal_transaksi', '<=', $request->sampai);
        }
        if ($request->jenis) {
            $query->where('jenis', $request->jenis);
        }

        $transaksi       = $query->latest()->paginate(15);
        $total_penjualan = Transaksi::where('cabang_id', $cabangId)->where('jenis', 'penjualan')->sum('total_harga');
        $total_pembelian = Transaksi::where('cabang_id', $cabangId)->where('jenis', 'pembelian')->sum('total_harga');

        return view('manajer.laporan', compact('transaksi', 'total_penjualan', 'total_pembelian'));
    }

    public function cetak(Request $request)
    {
        $cabangId = Auth::user()->cabang_id;
        $query    = Transaksi::with(['user', 'detailTransaksi.barang'])
                        ->where('cabang_id', $cabangId);

        if ($request->dari)   $query->whereDate('tanggal_transaksi', '>=', $request->dari);
        if ($request->sampai) $query->whereDate('tanggal_transaksi', '<=', $request->sampai);
        if ($request->jenis)  $query->where('jenis', $request->jenis);

        $transaksi = $query->latest()->get();
        $dari      = $request->dari   ?? 'Awal';
        $sampai    = $request->sampai ?? 'Sekarang';
        $periode   = "$dari s/d $sampai";

        $pdf = Pdf::loadView('manajer.laporan_cetak', compact('transaksi', 'periode'))
                  ->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-toko-' . now()->format('Ymd') . '.pdf');
    }
}
