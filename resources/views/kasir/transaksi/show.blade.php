@extends('layouts.app')
@section('title', 'Detail Transaksi')

@section('content')
<div class="card">
    <div class="card-header bg-success text-white d-flex justify-content-between">
        <span><i class="fas fa-receipt me-2"></i> Detail Transaksi</span>
        <button onclick="window.print()" class="btn btn-light btn-sm">
            <i class="fas fa-print"></i> Cetak
        </button>
    </div>
    <div class="card-body" id="print-area">
        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table table-borderless table-sm">
                    <tr><td>No Transaksi</td><td>: <strong><code>{{ $transaksi->no_transaksi }}</code></strong></td></tr>
                    <tr><td>Cabang</td><td>: {{ $transaksi->cabang->nama_cabang }}</td></tr>
                    <tr><td>Kasir</td><td>: {{ $transaksi->user->name }}</td></tr>
                    <tr><td>Jenis</td><td>:
                        <span class="badge {{ $transaksi->jenis === 'penjualan' ? 'bg-success' : 'bg-info' }}">
                            {{ ucfirst($transaksi->jenis) }}
                        </span>
                    </td></tr>
                    <tr><td>Tanggal</td><td>: {{ $transaksi->tanggal_transaksi->format('d F Y, H:i') }}</td></tr>
                </table>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Barang</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi->detailTransaksi as $i => $d)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $d->barang->nama_barang }}</td>
                    <td>Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $d->jumlah }} {{ $d->barang->satuan }}</td>
                    <td>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-success">
                    <td colspan="4" class="text-end fw-bold">Total</td>
                    <td class="fw-bold">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                </tr>
                @if($transaksi->bayar)
                <tr>
                    <td colspan="4" class="text-end">Bayar</td>
                    <td>Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end">Kembalian</td>
                    <td>Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</td>
                </tr>
                @endif
            </tfoot>
        </table>
    </div>
    <div class="card-footer">
        <a href="{{ route('kasir.transaksi.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>
@endsection
