@extends('layouts.app')
@section('title', 'Detail Cabang')

@section('content')

{{-- Info Cabang --}}
<div class="card mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <span><i class="fas fa-store me-2"></i> {{ $cabang->nama_cabang }}</span>
        <a href="{{ route('owner.cabang.edit', $cabang->id) }}" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i> Edit
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless table-sm">
                    <tr><td class="fw-bold" width="140">Nama Cabang</td><td>: {{ $cabang->nama_cabang }}</td></tr>
                    <tr><td class="fw-bold">Kota</td><td>: {{ $cabang->kota }}</td></tr>
                    <tr><td class="fw-bold">Alamat</td><td>: {{ $cabang->alamat }}</td></tr>
                    <tr><td class="fw-bold">Telepon</td><td>: {{ $cabang->telepon ?? '-' }}</td></tr>
                    <tr><td class="fw-bold">Status</td>
                        <td>:
                            @if($cabang->is_aktif)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="stat-card" style="background: linear-gradient(135deg,#27ae60,#2ecc71)">
                            <div class="number">Rp {{ number_format($total_penjualan, 0, ',', '.') }}</div>
                            <div class="label">Total Penjualan</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card" style="background: linear-gradient(135deg,#e74c3c,#c0392b)">
                            <div class="number">Rp {{ number_format($total_pembelian, 0, ',', '.') }}</div>
                            <div class="label">Total Pembelian</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Daftar Pegawai --}}
<div class="card mb-4">
    <div class="card-header bg-secondary text-white">
        <i class="fas fa-users me-2"></i> Pegawai Cabang ({{ $users->count() }} orang)
    </div>
    <div class="card-body">
        <table class="table table-sm table-hover">
            <thead class="table-light">
                <tr><th>Nama</th><th>Email</th><th>Role</th></tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <span class="badge bg-primary">
                            {{ ucfirst(str_replace('_', ' ', $u->role)) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center text-muted">Belum ada pegawai</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Stok Menipis --}}
@if($stok_menipis->count() > 0)
<div class="card mb-4 border-danger">
    <div class="card-header bg-danger text-white">
        <i class="fas fa-exclamation-triangle me-2"></i> Stok Menipis ({{ $stok_menipis->count() }} item)
    </div>
    <div class="card-body">
        <table class="table table-sm">
            <thead class="table-light">
                <tr><th>Barang</th><th>Stok Sekarang</th><th>Min. Stok</th></tr>
            </thead>
            <tbody>
                @foreach($stok_menipis as $s)
                <tr>
                    <td>{{ $s->barang->nama_barang }}</td>
                    <td><span class="badge bg-danger">{{ $s->jumlah_stok }}</span></td>
                    <td>{{ $s->stok_minimum }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- Transaksi Terbaru --}}
<div class="card">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-receipt me-2"></i> 10 Transaksi Terbaru
    </div>
    <div class="card-body">
        <table class="table table-sm table-hover">
            <thead class="table-light">
                <tr><th>No Transaksi</th><th>Kasir</th><th>Jenis</th><th>Total</th><th>Tanggal</th></tr>
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
                    <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $t->tanggal_transaksi->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada transaksi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('owner.cabang.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>
@endsection