@extends('layouts.app')
@section('title', 'Dashboard Kasir')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #1a3c5e, #2d6a9f)">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="number">{{ $total_transaksi }}</div>
                    <div class="label">Total Semua Transaksi</div>
                </div>
                <i class="fas fa-receipt"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #27ae60, #2ecc71)">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="number">{{ $transaksi_hari_ini }}</div>
                    <div class="label">Transaksi Hari Ini</div>
                </div>
                <i class="fas fa-calendar-day"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <span><i class="fas fa-receipt me-2"></i> Transaksi Terbaru</span>
        <a href="{{ route('kasir.transaksi.create') }}" class="btn btn-warning btn-sm">
            <i class="fas fa-plus"></i> Transaksi Baru
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr><th>No Transaksi</th><th>Jenis</th><th>Total</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($transaksi_terbaru as $t)
                <tr>
                    <td><code>{{ $t->no_transaksi }}</code></td>
                    <td><span class="badge {{ $t->jenis === 'penjualan' ? 'bg-success' : 'bg-info' }}">{{ ucfirst($t->jenis) }}</span></td>
                    <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    <td><a href="{{ route('kasir.transaksi.show', $t->id) }}" class="btn btn-sm btn-outline-primary">Detail</a></td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted">Belum ada transaksi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
