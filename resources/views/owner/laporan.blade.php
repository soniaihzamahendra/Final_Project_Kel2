@extends('layouts.app')
@section('title', 'Laporan Semua Cabang')

@section('content')
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-filter me-2"></i> Filter Laporan
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('owner.laporan') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Cabang</label>
                <select name="cabang_id" class="form-select">
                    <option value="">Semua Cabang</option>
                    @foreach($cabang as $c)
                        <option value="{{ $c->id }}" {{ request('cabang_id') == $c->id ? 'selected' : '' }}>
                            {{ $c->nama_cabang }}
                        </option>
                    @endforeach
                </select>
            </div>
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
            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Filter
                </button>
                <a href="{{ route('owner.laporan') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Reset
                </a>
                <a href="{{ route('owner.laporan.cetak', request()->all()) }}" 
                   class="btn btn-danger ms-auto" target="_blank">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Ringkasan --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #27ae60, #2ecc71)">
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
        <div class="stat-card" style="background: linear-gradient(135deg, #e74c3c, #c0392b)">
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
        <div class="stat-card" style="background: linear-gradient(135deg, #1a3c5e, #2d6a9f)">
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
        <i class="fas fa-table me-2"></i> Data Transaksi
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No Transaksi</th>
                    <th>Cabang</th>
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
                    <td>{{ $t->cabang->nama_cabang }}</td>
                    <td>{{ $t->user->name }}</td>
                    <td>
                        <span class="badge {{ $t->jenis === 'penjualan' ? 'bg-success' : 'bg-info' }}">
                            {{ ucfirst($t->jenis) }}
                        </span>
                    </td>
                    <td><strong>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</strong></td>
                    <td>{{ $t->tanggal_transaksi->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('owner.laporan.cetak', ['transaksi_id' => $t->id]) }}" 
                           class="btn btn-sm btn-outline-danger" target="_blank">
                            <i class="fas fa-print"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Tidak ada data transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $transaksi->withQueryString()->links() }}
    </div>
</div>
@endsection