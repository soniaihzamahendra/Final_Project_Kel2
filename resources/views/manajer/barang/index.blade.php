@extends('layouts.app')
@section('title', 'Kelola Barang')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span><i class="fas fa-box me-2"></i> Daftar Barang</span>
        <a href="{{ route('manajer.barang.create') }}" class="btn btn-warning btn-sm">
            <i class="fas fa-plus"></i> Tambah Barang
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th><th>Kode</th><th>Nama Barang</th><th>Kategori</th>
                    <th>Satuan</th><th>Harga Beli</th><th>Harga Jual</th><th>Stok</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barang as $i => $b)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><code>{{ $b->kode_barang }}</code></td>
                    <td>{{ $b->nama_barang }}</td>
                    <td>{{ $b->kategori->nama_kategori }}</td>
                    <td>{{ $b->satuan }}</td>
                    <td>Rp {{ number_format($b->harga_beli, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</td>
                    <td>
                        @php $stok = $b->stokBarang->first(); @endphp
                        <span class="badge {{ $stok && $stok->jumlah_stok <= $stok->stok_minimum ? 'bg-danger' : 'bg-success' }}">
                            {{ $stok ? $stok->jumlah_stok : 0 }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('manajer.barang.edit', $b->id) }}"
                               class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('manajer.barang.destroy', $b->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus barang ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">Belum ada barang</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
