<?php
namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['user'])
            ->where('cabang_id', Auth::user()->cabang_id)
            ->latest()
            ->paginate(15);

        return view('supervisor.transaksi.index', compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['detailTransaksi.barang', 'user', 'cabang'])
            ->where('cabang_id', Auth::user()->cabang_id)
            ->findOrFail($id);

        return view('supervisor.transaksi.show', compact('transaksi'));
    }
}
