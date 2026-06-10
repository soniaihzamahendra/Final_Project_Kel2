@extends('layouts.app')
@section('title', 'Tambah Barang')

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-plus-circle me-2"></i> Tambah Barang Baru
    </div>
    <div class="card-body">
        <form action="{{ route('manajer.barang.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Kode Barang *</label>
                    <input type="text" name="kode_barang"
                           class="form-control @error('kode_barang') is-invalid @enderror"
                           value="{{ old('kode_barang') }}" placeholder="cth: BRG013">
                    @error('kode_barang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Barang *</label>
                    <input type="text" name="nama_barang"
                           class="form-control @error('nama_barang') is-invalid @enderror"
                           value="{{ old('nama_barang') }}">
                    @error('nama_barang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Kategori *</label>
                    <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Satuan *</label>
                    <select name="satuan" class="form-select">
                        <option value="pcs">Pcs</option>
                        <option value="kg">Kg</option>
                        <option value="liter">Liter</option>
                        <option value="botol">Botol</option>
                        <option value="kaleng">Kaleng</option>
                        <option value="bungkus">Bungkus</option>
                        <option value="dus">Dus</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Harga Beli *</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="harga_beli"
                               class="form-control @error('harga_beli') is-invalid @enderror"
                               value="{{ old('harga_beli') }}" min="0">
                    </div>
                    @error('harga_beli')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Harga Jual *</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="harga_jual"
                               class="form-control @error('harga_jual') is-invalid @enderror"
                               value="{{ old('harga_jual') }}" min="0">
                    </div>
                    @error('harga_jual')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Stok Awal *</label>
                    <input type="number" name="stok_awal"
                           class="form-control @error('stok_awal') is-invalid @enderror"
                           value="{{ old('stok_awal', 0) }}" min="0">
                    <small class="text-muted">Akan diterapkan ke semua cabang</small>
                    @error('stok_awal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i> Simpan
                </button>
                <a href="{{ route('manajer.barang.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
