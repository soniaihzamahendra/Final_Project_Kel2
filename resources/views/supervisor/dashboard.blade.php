@extends('layouts.app')
@section('title', 'Dashboard Supervisor')

@section('content')
<div class="row g-4">
    <div class="col-md-6">
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
@endsection
