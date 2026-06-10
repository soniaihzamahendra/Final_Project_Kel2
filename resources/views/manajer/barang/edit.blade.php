@extends('layouts.app')
@section('title', 'Edit Barang')

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header bg-warning text-dark">
        <i class="fas fa-edit me-2"></i> Edit Barang — {{ $barang->nama_barang }}
    </div>
    <div class="card-body">
        <form action="{{ route('manajer.barang.update', $barang->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Kode Barang *</label>
                    <input type="text" name="kode_barang"
                           class="form-control @error('kode_barang') is-invalid @enderror"
                           value="{{ old('kode_barang', $barang->kode_barang) }}">
                    @error('kode_barang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Barang *</label>
                    <input type="text" name="nama_barang"
                           class="form-control @error('nama_barang') is-invalid @enderror"
                           value="{{ old('nama_barang', $barang->nama_barang) }}">
                    @error('nama_barang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Kategori *</label>
                    <select name="kategori_id" class="form-select">
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}" {{ $barang->kategori_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Satuan *</label>
                    <select name="satuan" class="form-select">
                        @foreach(['pcs','kg','liter','botol','kaleng','bungkus','dus'] as $s)
                            <option value="{{ $s }}" {{ $barang->satuan === $s ? 'selected' : '' }}>
                                {{ ucfirst($s) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Harga Beli *</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="harga_beli" class="form-control"
                               value="{{ old('harga_beli', $barang->harga_beli) }}" min="0">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Harga Jual *</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="harga_jual" class="form-control"
                               value="{{ old('harga_jual', $barang->harga_jual) }}" min="0">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Min. Stok (Cabang Ini)</label>
                    <input type="number" name="stok_minimum" class="form-control"
                           value="{{ old('stok_minimum', $stok->stok_minimum ?? 5) }}" min="0">
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning px-4">
                    <i class="fas fa-save me-2"></i> Update
                </button>
                <a href="{{ route('manajer.barang.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
