@extends('layouts.app')
@section('title', 'Riwayat Stok')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-history me-2"></i> Riwayat Keluar Masuk Stok
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Barang</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Stok Sebelum</th>
                    <th>Stok Sesudah</th>
                    <th>Oleh</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $r)
                <tr>
                    <td>{{ $r->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $r->barang->nama_barang }}</td>
                    <td>
                        <span class="badge {{ $r->jenis === 'masuk' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($r->jenis) }}
                        </span>
                    </td>
                    <td>{{ $r->jumlah }}</td>
                    <td>{{ $r->stok_sebelum }}</td>
                    <td>{{ $r->stok_sesudah }}</td>
                    <td>{{ $r->user->name }}</td>
                    <td>{{ $r->keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Belum ada riwayat stok</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $riwayat->links() }}
    </div>
</div>
@endsection
