@extends('layouts.admin')
@section('title', 'Tambah Anggota Tim')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.team.index') }}">Tim</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-plus text-orange me-2"></i>Tambah Anggota Tim</h4>
    <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary rounded-pill px-3"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="form-card">
    <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6"><label class="form-label">Jabatan <span class="text-danger">*</span></label>
                <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position') }}" required>
                @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12"><label class="form-label">Bio Singkat</label>
                <textarea name="bio" class="form-control" rows="3">{{ old('bio') }}</textarea>
            </div>
            <div class="col-md-4"><label class="form-label">Foto</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
            <div class="col-md-4"><label class="form-label">LinkedIn URL</label>
                <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin') }}" placeholder="https://linkedin.com/in/...">
            </div>
            <div class="col-md-4"><label class="form-label">Twitter URL</label>
                <input type="url" name="twitter" class="form-control" value="{{ old('twitter') }}" placeholder="https://twitter.com/...">
            </div>
            <div class="col-md-4"><label class="form-label">Urutan Tampil</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
            </div>
            <div class="col-md-8 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                    <label class="form-check-label fw-600">Tampilkan di Website</label>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-orange px-4 rounded-pill"><i class="fas fa-save me-1"></i> Simpan</button>
            <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
        </div>
    </form>
</div>
@endsection
