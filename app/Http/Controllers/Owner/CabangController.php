<?php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Cabang;              
use App\Models\User;                
use App\Models\Transaksi;           
use App\Models\StokBarang;          
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function index()
    {
        $cabang = Cabang::withCount(['users', 'transaksi'])->get();
        return view('owner.cabang.index', compact('cabang'));
    }

    public function create()
    {
        return view('owner.cabang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_cabang' => 'required|string|max:100',
            'kota'        => 'required|string|max:100',
            'alamat'      => 'required|string',
            'telepon'     => 'nullable|string|max:20',
        ]);

        Cabang::create($request->all());

        return redirect()->route('owner.cabang.index')
            ->with('success', 'Cabang berhasil ditambahkan!');
    }

    public function show($id)
    {
        $cabang    = Cabang::withCount('transaksi')->findOrFail($id);
        $users     = User::where('cabang_id', $id)->get();
        $stok_menipis = StokBarang::where('cabang_id', $id)
                        ->whereColumn('jumlah_stok', '<=', 'stok_minimum')
                        ->with('barang')
                        ->get();
        $transaksi = Transaksi::with('user')
                        ->where('cabang_id', $id)
                        ->latest()
                        ->take(10)
                        ->get();
        $total_penjualan = Transaksi::where('cabang_id', $id)
                            ->where('jenis', 'penjualan')
                            ->sum('total_harga');
        $total_pembelian = Transaksi::where('cabang_id', $id)
                            ->where('jenis', 'pembelian')
                            ->sum('total_harga');

        return view('owner.cabang.show', compact(
            'cabang', 'users', 'stok_menipis',
            'transaksi', 'total_penjualan', 'total_pembelian'
        ));
    }

    public function edit($id)
    {
        $cabang = Cabang::findOrFail($id);
        return view('owner.cabang.edit', compact('cabang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_cabang' => 'required|string|max:100',
            'kota'        => 'required|string|max:100',
            'alamat'      => 'required|string',
            'telepon'     => 'nullable|string|max:20',
            'is_aktif'    => 'boolean',
        ]);

        $cabang = Cabang::findOrFail($id);
        $cabang->update($request->all());

        return redirect()->route('owner.cabang.index')
            ->with('success', 'Cabang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $cabang = Cabang::findOrFail($id);
        $cabang->delete();

        return redirect()->route('owner.cabang.index')
            ->with('success', 'Cabang berhasil dihapus!');
    }
}