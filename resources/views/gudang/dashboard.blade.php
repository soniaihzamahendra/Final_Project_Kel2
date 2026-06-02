@extends('layouts.app')
@section('title', 'Dashboard Gudang')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #1a3c5e, #2d6a9f)">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="number">{{ $total_barang }}</div>
                    <div class="label">Total Jenis Barang</div>
                </div>
                <i class="fas fa-boxes"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6">
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

@if($stok_list->count() > 0)
<div class="card border-danger">
    <div class="card-header bg-danger text-white">
        <i class="fas fa-exclamation-triangle me-2"></i> Barang Stok Menipis — Perlu Restock!
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr><th>Barang</th><th>Stok Sekarang</th><th>Minimum Stok</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @foreach($stok_list as $s)
                <tr>
                    <td>{{ $s->barang->nama_barang }}</td>
                    <td><span class="badge bg-danger">{{ $s->jumlah_stok }}</span></td>
                    <td>{{ $s->stok_minimum }}</td>
                    <td><a href="{{ route('gudang.stok.index') }}" class="btn btn-sm btn-warning">Update Stok</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
