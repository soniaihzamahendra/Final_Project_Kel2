@extends('layouts.app')
@section('title', 'Kelola Stok')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <span><i class="fas fa-boxes me-2"></i> Stok Barang — {{ auth()->user()->cabang->nama_cabang }}</span>
        <a href="{{ route('gudang.stok.riwayat') }}" class="btn btn-light btn-sm">
            <i class="fas fa-history"></i> Riwayat Stok
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Min. Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
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
                            <span class="badge bg-danger">Menipis!</span>
                        @else
                            <span class="badge bg-success">Aman</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalStok{{ $s->id }}">
                            <i class="fas fa-edit"></i> Update
                        </button>
                    </td>
                </tr>

                {{-- Modal Update Stok --}}
                <div class="modal fade" id="modalStok{{ $s->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">Update Stok — {{ $s->barang->nama_barang }}</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('gudang.stok.update', $s->id) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-body">
                                    <p>Stok saat ini: <strong>{{ $s->jumlah_stok }} {{ $s->barang->satuan }}</strong></p>
                                    <div class="mb-3">
                                        <label class="form-label">Jenis</label>
                                        <select name="jenis" class="form-select" required>
                                            <option value="masuk">Stok Masuk</option>
                                            <option value="keluar">Stok Keluar</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah</label>
                                        <input type="number" name="jumlah" class="form-control" min="1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Keterangan</label>
                                        <input type="text" name="keterangan" class="form-control" placeholder="Opsional">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
