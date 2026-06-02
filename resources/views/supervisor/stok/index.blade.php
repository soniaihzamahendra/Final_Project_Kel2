@extends('layouts.app')
@section('title', 'Monitor Stok')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <span><i class="fas fa-boxes me-2"></i> Monitor Stok — {{ auth()->user()->cabang->nama_cabang }}</span>
        <a href="{{ route('supervisor.stok.riwayat') }}" class="btn btn-light btn-sm">
            <i class="fas fa-history"></i> Riwayat Stok
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr><th>#</th><th>Kode</th><th>Nama Barang</th><th>Kategori</th><th>Stok</th><th>Min. Stok</th><th>Status</th></tr>
            </thead>
            <tbody>
                @foreach($stok as $i => $s)
                <tr class="{{ $s->isStokMenupis() ? 'table-danger' : '' }}">
                    <td>{{ $i + 1 }}</td>
                    <td><code>{{ $s->barang->kode_barang }}</code></td>
                    <td>{{ $s->barang->nama_barang }}</td>
                    <td>{{ $s->barang->kategori->nama_kategori }}</td>
                    <td><strong>{{ $s->jumlah_stok }}</strong> {{ $s->barang->satuan }}</td>
                    <td>{{ $s->stok_minimum }}</td>
                    <td>
                        @if($s->isStokMenupis())
                            <span class="badge bg-danger">⚠ Menipis</span>
                        @else
                            <span class="badge bg-success">Aman</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
