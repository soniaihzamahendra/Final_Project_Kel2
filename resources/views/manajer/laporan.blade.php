@extends('layouts.app')
@section('title', 'Laporan Toko')

@section('content')
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-filter me-2"></i> Filter Laporan — {{ auth()->user()->cabang->nama_cabang }}
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('manajer.laporan') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Tanggal Akhir</label>
                <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Jenis</label>
                <select name="jenis" class="form-select">
                    <option value="">Semua</option>
                    <option value="penjualan" {{ request('jenis') === 'penjualan' ? 'selected' : '' }}>Penjualan</option>
                    <option value="pembelian" {{ request('jenis') === 'pembelian' ? 'selected' : '' }}>Pembelian</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">
                    <i class="fas fa-search"></i> Filter
                </button>
                <a href="{{ route('manajer.laporan') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <div class="col-12">
                <a href="{{ route('manajer.laporan.cetak', request()->all()) }}"
                   class="btn btn-danger" target="_blank">
                    <i class="fas fa-file-pdf me-2"></i> Export PDF
                </a>
            </div>
        </form>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#27ae60,#2ecc71)">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="number">Rp {{ number_format($total_penjualan, 0, ',', '.') }}</div>
                    <div class="label">Total Penjualan</div>
                </div>
                <i class="fas fa-arrow-up"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#e74c3c,#c0392b)">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="number">Rp {{ number_format($total_pembelian, 0, ',', '.') }}</div>
                    <div class="label">Total Pembelian</div>
                </div>
                <i class="fas fa-arrow-down"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#1a3c5e,#2d6a9f)">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="number">{{ $transaksi->total() }}</div>
                    <div class="label">Total Transaksi</div>
                </div>
                <i class="fas fa-receipt"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-table me-2"></i> Data Transaksi Toko
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No Transaksi</th>
                    <th>Kasir</th>
                    <th>Jenis</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $t)
                <tr>
                    <td><code>{{ $t->no_transaksi }}</code></td>
                    <td>{{ $t->user->name }}</td>
                    <td>
                        <span class="badge {{ $t->jenis === 'penjualan' ? 'bg-success' : 'bg-info' }}">
                            {{ ucfirst($t->jenis) }}
                        </span>
                    </td>
                    <td><strong>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</strong></td>
                    <td>{{ $t->tanggal_transaksi->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('manajer.transaksi.show', $t->id) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $transaksi->withQueryString()->links() }}
    </div>
</div>
@endsection