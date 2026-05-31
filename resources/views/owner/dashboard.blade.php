@extends('layouts.app')
@section('title', 'Dashboard Owner')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #1a3c5e, #2d6a9f)">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="number">{{ $total_cabang }}</div>
                    <div class="label">Total Cabang</div>
                </div>
                <i class="fas fa-store"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #27ae60, #2ecc71)">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="number">{{ $total_transaksi }}</div>
                    <div class="label">Total Transaksi</div>
                </div>
                <i class="fas fa-receipt"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #f0a500, #f39c12)">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="number">Rp {{ number_format($transaksi_hari_ini, 0, ',', '.') }}</div>
                    <div class="label">Pendapatan Hari Ini</div>
                </div>
                <i class="fas fa-money-bill"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
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
        <i class="fas fa-store me-2"></i> Performa Per Cabang
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Cabang</th>
                    <th>Kota</th>
                    <th>Total Transaksi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cabang as $i => $c)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $c->nama_cabang }}</strong></td>
                    <td>{{ $c->kota }}</td>
                    <td><span class="badge bg-success">{{ $c->transaksi_count }} transaksi</span></td>
                    <td>
                        @if($c->is_aktif)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection