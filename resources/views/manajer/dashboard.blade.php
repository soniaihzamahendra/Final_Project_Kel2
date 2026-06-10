@extends('layouts.app')
@section('title', 'Dashboard Manajer')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #1a3c5e, #2d6a9f)">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="number">{{ $total_transaksi }}</div>
                    <div class="label">Total Transaksi Toko</div>
                </div>
                <i class="fas fa-receipt"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #27ae60, #2ecc71)">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="number">Rp {{ number_format($pendapatan_hari_ini, 0, ',', '.') }}</div>
                    <div class="label">Pendapatan Hari Ini</div>
                </div>
                <i class="fas fa-money-bill"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #e74c3c, #c0392b)">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="number">{{ $stok_menipis }}</div>
                    <div class="label">Stok Menipis</div>
                </div>
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-receipt me-2"></i> Transaksi Terbaru
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>No Transaksi</th>
                    <th>Kasir</th>
                    <th>Jenis</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi_terbaru as $t)
                <tr>
                    <td><code>{{ $t->no_transaksi }}</code></td>
                    <td>{{ $t->user->name }}</td>
                    <td>
                        <span class="badge {{ $t->jenis === 'penjualan' ? 'bg-success' : 'bg-info' }}">
                            {{ ucfirst($t->jenis) }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $t->tanggal_transaksi->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
