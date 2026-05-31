@extends('layouts.app')
@section('title', 'Kelola Cabang')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span><i class="fas fa-store me-2"></i> Daftar Cabang</span>
        <a href="{{ route('owner.cabang.create') }}" class="btn btn-warning btn-sm">
            <i class="fas fa-plus"></i> Tambah Cabang
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Cabang</th>
                    <th>Kota</th>
                    <th>Telepon</th>
                    <th>Pegawai</th>
                    <th>Transaksi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cabang as $i => $c)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <strong>{{ $c->nama_cabang }}</strong><br>
                        <small class="text-muted">{{ $c->alamat }}</small>
                    </td>
                    <td>{{ $c->kota }}</td>
                    <td>{{ $c->telepon ?? '-' }}</td>
                    <td><span class="badge bg-primary">{{ $c->users_count }} orang</span></td>
                    <td><span class="badge bg-success">{{ $c->transaksi_count }} transaksi</span></td>
                    <td>
                        @if($c->is_aktif)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('owner.cabang.show', $c->id) }}"
                               class="btn btn-sm btn-outline-info" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('owner.cabang.edit', $c->id) }}"
                               class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('owner.cabang.destroy', $c->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus cabang ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        Belum ada cabang. <a href="{{ route('owner.cabang.create') }}">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection