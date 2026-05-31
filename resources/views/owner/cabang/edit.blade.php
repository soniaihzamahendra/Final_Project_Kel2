@extends('layouts.app')
@section('title', 'Edit Cabang')

@section('content')
<div class="card" style="max-width: 700px;">
    <div class="card-header bg-warning text-dark">
        <i class="fas fa-edit me-2"></i> Edit Cabang — {{ $cabang->nama_cabang }}
    </div>
    <div class="card-body">
        <form action="{{ route('owner.cabang.update', $cabang->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Cabang <span class="text-danger">*</span></label>
                <input type="text" name="nama_cabang"
                       class="form-control @error('nama_cabang') is-invalid @enderror"
                       value="{{ old('nama_cabang', $cabang->nama_cabang) }}">
                @error('nama_cabang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Kota <span class="text-danger">*</span></label>
                <input type="text" name="kota"
                       class="form-control @error('kota') is-invalid @enderror"
                       value="{{ old('kota', $cabang->kota) }}">
                @error('kota')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Alamat <span class="text-danger">*</span></label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                          rows="3">{{ old('alamat', $cabang->alamat) }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Telepon</label>
                <input type="text" name="telepon" class="form-control"
                       value="{{ old('telepon', $cabang->telepon) }}">
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Status</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_aktif"
                           value="1" {{ $cabang->is_aktif ? 'checked' : '' }}>
                    <label class="form-check-label">Cabang Aktif</label>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning px-4">
                    <i class="fas fa-save me-2"></i> Update
                </button>
                <a href="{{ route('owner.cabang.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection