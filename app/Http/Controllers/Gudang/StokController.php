<?php
namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use App\Models\StokBarang;         
use App\Models\RiwayatStok;        
use App\Models\Barang;             
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StokController extends Controller
{
    public function index()
    {
        $stok = StokBarang::with('barang.kategori')
            ->where('cabang_id', Auth::user()->cabang_id)
            ->get();

        return view('gudang.stok.index', compact('stok'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis'      => 'required|in:masuk,keluar',
            'jumlah'     => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $stok        = StokBarang::findOrFail($id);
        $stokSebelum = $stok->jumlah_stok;

        if ($request->jenis === 'masuk') {
            $stok->increment('jumlah_stok', $request->jumlah);
        } else {
            $stok->decrement('jumlah_stok', $request->jumlah);
        }

        RiwayatStok::create([
            'cabang_id'    => Auth::user()->cabang_id,
            'barang_id'    => $stok->barang_id,
            'user_id'      => Auth::id(),
            'jenis'        => $request->jenis,
            'jumlah'       => $request->jumlah,
            'stok_sebelum' => $stokSebelum,
            'stok_sesudah' => $stok->fresh()->jumlah_stok,
            'keterangan'   => $request->keterangan,
        ]);

        return back()->with('success', 'Stok berhasil diperbarui!');
    }

    public function riwayat()
    {
        $riwayat = RiwayatStok::with(['barang', 'user'])
            ->where('cabang_id', Auth::user()->cabang_id)
            ->latest()
            ->paginate(15);

        return view('gudang.stok.riwayat', compact('riwayat'));
    }
}
