@extends('layouts.app')
@section('title', 'Tambah Cabang')

@section('content')
<div class="card" style="max-width: 700px;">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-plus-circle me-2"></i> Tambah Cabang Baru
    </div>
    <div class="card-body">
        <form action="{{ route('owner.cabang.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Cabang <span class="text-danger">*</span></label>
                <input type="text" name="nama_cabang" class="form-control @error('nama_cabang') is-invalid @enderror"
                       value="{{ old('nama_cabang') }}" placeholder="cth: Jayusman Mart Depok">
                @error('nama_cabang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Kota <span class="text-danger">*</span></label>
                <input type="text" name="kota" class="form-control @error('kota') is-invalid @enderror"
                       value="{{ old('kota') }}" placeholder="cth: Depok">
                @error('kota')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Alamat Lengkap <span class="text-danger">*</span></label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                          rows="3" placeholder="Jl. ...">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">No. Telepon</label>
                <input type="text" name="telepon" class="form-control"
                       value="{{ old('telepon') }}" placeholder="cth: 021-123456">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i> Simpan
                </button>
                <a href="{{ route('owner.cabang.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection