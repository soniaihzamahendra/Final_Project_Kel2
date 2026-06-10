<?php
namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;          
use App\Models\DetailTransaksi;    
use App\Models\Barang;             
use App\Models\StokBarang;         
use App\Models\RiwayatStok;        
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['cabang', 'user'])
            ->where('cabang_id', Auth::user()->cabang_id)
            ->latest()
            ->paginate(10);

        return view('kasir.transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $barang = Barang::with(['stokBarang' => function ($q) {
            $q->where('cabang_id', Auth::user()->cabang_id);
        }])->get();

        return view('kasir.transaksi.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis'              => 'required|in:penjualan,pembelian',
            'items'              => 'required|array|min:1',
            'items.*.barang_id'  => 'required|exists:barang,id',
            'items.*.jumlah'     => 'required|integer|min:1',
            'bayar'              => 'nullable|numeric',
        ]);

        DB::beginTransaction();
        try {
            $cabangId = Auth::user()->cabang_id;
            $total    = 0;

            // Hitung total
            foreach ($request->items as $item) {
                $barang = Barang::findOrFail($item['barang_id']);
                $harga  = $request->jenis === 'penjualan' ? $barang->harga_jual : $barang->harga_beli;
                $total += $harga * $item['jumlah'];
            }

            // Simpan header transaksi
            $transaksi = Transaksi::create([
                'no_transaksi'      => Transaksi::generateNoTransaksi($request->jenis),
                'cabang_id'         => $cabangId,
                'user_id'           => Auth::id(),
                'jenis'             => $request->jenis,
                'total_harga'       => $total,
                'bayar'             => $request->bayar,
                'kembalian'         => $request->bayar ? $request->bayar - $total : null,
                'tanggal_transaksi' => now(),
            ]);

            // Simpan detail & update stok
            foreach ($request->items as $item) {
                $barang  = Barang::findOrFail($item['barang_id']);
                $harga   = $request->jenis === 'penjualan' ? $barang->harga_jual : $barang->harga_beli;
                $subtotal = $harga * $item['jumlah'];

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id'    => $barang->id,
                    'jumlah'       => $item['jumlah'],
                    'harga_satuan' => $harga,
                    'subtotal'     => $subtotal,
                ]);

                // Update stok
                $stok = StokBarang::where('cabang_id', $cabangId)
                    ->where('barang_id', $barang->id)
                    ->first();

                $stokSebelum = $stok->jumlah_stok;

                if ($request->jenis === 'penjualan') {
                    $stok->decrement('jumlah_stok', $item['jumlah']);
                } else {
                    $stok->increment('jumlah_stok', $item['jumlah']);
                }

                // Catat riwayat stok
                RiwayatStok::create([
                    'cabang_id'    => $cabangId,
                    'barang_id'    => $barang->id,
                    'user_id'      => Auth::id(),
                    'jenis'        => $request->jenis === 'penjualan' ? 'keluar' : 'masuk',
                    'jumlah'       => $item['jumlah'],
                    'stok_sebelum' => $stokSebelum,
                    'stok_sesudah' => $stok->fresh()->jumlah_stok,
                    'keterangan'   => 'Dari transaksi ' . $transaksi->no_transaksi,
                ]);
            }

            DB::commit();
            return redirect()->route('kasir.transaksi.show', $transaksi->id)
                ->with('success', 'Transaksi berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['detailTransaksi.barang', 'cabang', 'user'])
            ->where('cabang_id', Auth::user()->cabang_id)
            ->findOrFail($id);

        return view('kasir.transaksi.show', compact('transaksi'));
    }
}
