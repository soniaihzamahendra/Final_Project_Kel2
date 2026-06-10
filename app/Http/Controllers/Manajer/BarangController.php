<?php
namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with(['kategori', 'stokBarang' => function($q) {
            $q->where('cabang_id', Auth::user()->cabang_id);
        }])->get();

        return view('manajer.barang.index', compact('barang'));
    }

    public function create()
    {
        $kategori = KategoriBarang::all();
        return view('manajer.barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang'  => 'required|unique:barang,kode_barang',
            'nama_barang'  => 'required|string',
            'kategori_id'  => 'required|exists:kategori_barang,id',
            'satuan'       => 'required|string',
            'harga_beli'   => 'required|numeric|min:0',
            'harga_jual'   => 'required|numeric|min:0',
            'stok_awal'    => 'required|integer|min:0',
        ]);

        $barang = Barang::create($request->only([
            'kode_barang', 'nama_barang', 'kategori_id',
            'satuan', 'harga_beli', 'harga_jual'
        ]));

        // Buat stok untuk semua cabang
        \App\Models\Cabang::all()->each(function($cabang) use ($barang, $request) {
            StokBarang::create([
                'cabang_id'   => $cabang->id,
                'barang_id'   => $barang->id,
                'jumlah_stok' => $request->stok_awal,
                'stok_minimum'=> 5,
            ]);
        });

        return redirect()->route('manajer.barang.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang   = Barang::findOrFail($id);
        $kategori = KategoriBarang::all();
        $stok     = StokBarang::where('barang_id', $id)
                        ->where('cabang_id', Auth::user()->cabang_id)
                        ->first();

        return view('manajer.barang.edit', compact('barang', 'kategori', 'stok'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang,' . $id,
            'nama_barang' => 'required|string',
            'kategori_id' => 'required|exists:kategori_barang,id',
            'satuan'      => 'required|string',
            'harga_beli'  => 'required|numeric|min:0',
            'harga_jual'  => 'required|numeric|min:0',
            'stok_minimum'=> 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->only([
            'kode_barang', 'nama_barang', 'kategori_id',
            'satuan', 'harga_beli', 'harga_jual'
        ]));

        // Update stok minimum cabang ini
        StokBarang::where('barang_id', $id)
            ->where('cabang_id', Auth::user()->cabang_id)
            ->update(['stok_minimum' => $request->stok_minimum]);

        return redirect()->route('manajer.barang.index')
            ->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
{
    $barang = Barang::findOrFail($id);

    // Proteksi: barang yang sudah ada di transaksi tidak boleh dihapus
    $adaDiTransaksi = \App\Models\DetailTransaksi::where('barang_id', $id)->exists();

    if ($adaDiTransaksi) {
        return redirect()->route('manajer.barang.index')
            ->with('error', '⚠ Barang "' . $barang->nama_barang . '" tidak bisa dihapus karena sudah pernah digunakan dalam transaksi. Nonaktifkan saja jika tidak ingin ditampilkan.');
    }

    // Hapus stok & riwayat dulu (cascade manual untuk yang belum ada di transaksi)
    \App\Models\StokBarang::where('barang_id', $id)->delete();
    \App\Models\RiwayatStok::where('barang_id', $id)->delete();

    $barang->delete();

    return redirect()->route('manajer.barang.index')
        ->with('success', 'Barang "' . $barang->nama_barang . '" berhasil dihapus!');
}
}