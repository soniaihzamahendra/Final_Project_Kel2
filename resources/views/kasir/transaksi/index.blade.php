@extends('layouts.app')
@section('title', 'Daftar Transaksi')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span><i class="fas fa-receipt me-2"></i> Daftar Transaksi</span>
        <a href="{{ route('kasir.transaksi.create') }}" class="btn btn-warning btn-sm">
            <i class="fas fa-plus"></i> Transaksi Baru
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No Transaksi</th>
                    <th>Jenis</th>
                    <th>Total</th>
                    <th>Kasir</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $t)
                <tr>
                    <td><code>{{ $t->no_transaksi }}</code></td>
                    <td>
                        <span class="badge {{ $t->jenis === 'penjualan' ? 'bg-success' : 'bg-info' }}">
                            {{ ucfirst($t->jenis) }}
                        </span>
                    </td>
                    <td><strong>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</strong></td>
                    <td>{{ $t->user->name }}</td>
                    <td>{{ $t->tanggal_transaksi->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('kasir.transaksi.show', $t->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $transaksi->links() }}
    </div>
</div>
@endsection
