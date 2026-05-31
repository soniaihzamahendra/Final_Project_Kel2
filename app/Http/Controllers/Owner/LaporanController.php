<?php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;           
use App\Models\Cabang;              
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;    

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['cabang', 'user']);

        if ($request->cabang_id) {
            $query->where('cabang_id', $request->cabang_id);
        }
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
        $total_penjualan = (clone $query)->where('jenis', 'penjualan')->sum('total_harga');
        $total_pembelian = (clone $query)->where('jenis', 'pembelian')->sum('total_harga');
        $cabang          = Cabang::all();

        return view('owner.laporan', compact(
            'transaksi', 'cabang', 'total_penjualan', 'total_pembelian'
        ));
    }

    public function cetak(Request $request)
    {
        $query = Transaksi::with(['cabang', 'user', 'detailTransaksi.barang']);

        if ($request->cabang_id) {
            $query->where('cabang_id', $request->cabang_id);
        }
        if ($request->dari) {
            $query->whereDate('tanggal_transaksi', '>=', $request->dari);
        }
        if ($request->sampai) {
            $query->whereDate('tanggal_transaksi', '<=', $request->sampai);
        }
        if ($request->jenis) {
            $query->where('jenis', $request->jenis);
        }

        $transaksi     = $query->latest()->get();
        $cabang        = Cabang::all();
        $cabang_filter = $request->cabang_id
            ? Cabang::find($request->cabang_id)->nama_cabang
            : 'Semua Cabang';

        $dari   = $request->dari   ?? 'Awal';
        $sampai = $request->sampai ?? 'Sekarang';
        $periode = "$dari s/d $sampai";

        $pdf = Pdf::loadView('owner.laporan_cetak', compact(
            'transaksi', 'cabang', 'cabang_filter', 'periode'
        ))->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-transaksi-' . now()->format('Ymd') . '.pdf');
    }
}